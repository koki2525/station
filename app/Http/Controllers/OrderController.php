<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\Station;

class OrderController extends Controller
{
    private $fuelCosts = [
        'ulp93' => 2.50,
        'ulp95' => 2.75,
        'diesel' => 2.00,
    ];

    public function create()
    {
        return view('order.create');
    }

    public function store(Request $request)
    {
        // Perform date validation
        $request->validate([
            'desiredDeliveryDate' => 'required|date|after_or_equal:2 days',
            'amountULP93' => 'required|integer|min:0',
            'amountULP95' => 'required|integer|min:0',
            'amountDiesel' => 'required|integer|min:0',
        ]);

        $station = Station::where('user_id', auth()->id())->first();

        $orderAmount = [
            'ulp93' => $request->amountULP93,
            'ulp95' => $request->amountULP95,
            'diesel' => $request->amountDiesel,
        ];

        // Check if the order exceeds station capacity
        if (!$this->checkStationCapacity($orderAmount, $station)) {
            return back()->with('error', 'Order quantity exceeds station capacity.');
        }

        // Calculate the projected cost
        $projectedCost = $this->calculateProjectedCost($orderAmount);

        // Calculate the remaining stock after delivery
        $remainingStock = $this->calculateRemainingStock($orderAmount, $station);

        //Calculate the projected total capital
        $projectedTotalCapital = $this->calculateProjectedTotalCapital($orderAmount, $station);

        //Calculate if the fuel will run out before the delivery arrives
        $runOutBeforeDelivery = $this->willFuelRunOutBeforeOrder($orderAmount, $station);

        // Find the truck that can accommodate the order
        $selectedTruck = $this->findSuitableTruck($orderAmount);

        if (!$selectedTruck) {
            return back()->with('error', 'No suitable truck found for the order.');
        }

        // Check if the selected truck can accommodate the order
        if (!$this->truckCanAccommodateOrder($orderAmount, $selectedTruck)) {
            return back()->with('error', 'Order does not comply with truck constraints.');
        }

        try {
            $order = new Order();
            $order->desired_delivery_date = $request->desiredDeliveryDate;
            $order->amount_ulp93 = $request->amountULP93;
            $order->amount_ulp95 = $request->amountULP95;
            $order->amount_diesel = $request->amountDiesel;
            $order->user_id = auth()->id();
            $order->projected_cost = $projectedCost;
            $order->save();

            return view('order.order', compact('projectedCost', 'remainingStock', 'projectedTotalCapital', 'runOutBeforeDelivery'))
                ->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            Log::error('Error saving order: ' . $e->getMessage());
            return back()->with('error', 'Failed to save order. Please check the logs for details.');
        }
    }

    private function checkStationCapacity($orderAmount, $station)
    {
        foreach ($orderAmount as $type => $amount) {
            $stock = $station[$type . '_stock'] ?? 0;

            $capacity = $station[$type . '_capacity'] ?? 0;

            if (($amount + $stock) > $capacity) {
                return false;
            }
        }
        return true;
    }

    private function calculateProjectedCost($orderAmount)
    {
        $totalCost = 0;

        foreach ($orderAmount as $type => $amount) {
            // Calculate the cost of the ordered fuel type using class property
            $fuelCost = $this->fuelCosts[$type] ?? 0; // Use the defined cost or default to 0 if not found
            $totalCost += $fuelCost * $amount;
        }

        return $totalCost;
    }

    private function calculateRemainingStock($orderAmount, $station)
    {
        $remainingStock = [];

        foreach ($orderAmount as $type => $amount) {
            // Calculate the remaining stock for each fuel type plus the amount ordered
            $remainingStock[$type] = $station[$type . '_stock'] + $amount;
        }

        return $remainingStock;
    }

    private function calculateProjectedTotalCapital($orderAmount, $station)
    {
        $totalCapital = 0;

        foreach ($orderAmount as $type => $amount) {
            // Calculate the cost of the ordered fuel type using class property
            $fuelCost = $this->fuelCosts[$type] ?? 0; // Use the defined cost or default to 0 if not found

            // Include the existing stock in the calculation
            $existingStock = $station[$type . '_stock'] ?? 0;
            $totalCapital += $fuelCost * ($amount + $existingStock);
        }

        return $totalCapital;
    }


    private function willFuelRunOutBeforeOrder($orderAmount, $station)
    {
        // Calculate the remaining stock after the order
        $remainingStock = $this->calculateRemainingStock($orderAmount, $station);

        // Calculate the projected stock after considering daily demand until desired delivery date
        $projectedStock = [];
        $deliveryDate = Carbon::parse(request('desiredDeliveryDate'));

        foreach ($orderAmount as $type => $amount) {
            $dailyDemand = $station[$type . '_demand'];
            $daysUntilDelivery = Carbon::now()->diffInDays($deliveryDate);

            $projectedStock[$type] = $remainingStock[$type] - ($dailyDemand * $daysUntilDelivery);

            // Ensure the projected stock is not negative
            if ($projectedStock[$type] < 0) {
                $projectedStock[$type] = 0;
            }
        }

        // Check if any fuel type will run out before the order arrives
        foreach ($projectedStock as $type => $stock) {
            if ($stock < 0) {
                return true; // Fuel will run out before the order arrives
            }
        }

        return false; // Fuel will not run out before the order arrives
    }

    private function findSuitableTruck($orderAmount)
    {
        $trucks = json_decode(file_get_contents(public_path('wholesaler_trucks.json')), true)['wholesaler_trailers'];

        foreach ($trucks as $truck) {
            // Check if the truck can accommodate the order
            if ($this->truckCanAccommodateOrder($orderAmount, $truck)) {
                return $truck; // Return the first suitable truck found
            }
        }

        return null; // Return null if no suitable truck is found
    }

    private function truckCanAccommodateOrder($orderAmount, $truck)
    {
        $compartments = $truck['compartments'];

        // Check if the available truck can accommodate the order
        foreach ($orderAmount as $type => $amount) {
            if ($amount > 0) {
                // Check if the fuel type is allowed in any compartment
                $allowedCompartments = array_filter($compartments, function ($compartment) use ($type) {
                    return $compartment['fuel_type'] === $type;
                });

                if (empty($allowedCompartments)) {
                    return false;
                }

                // Check if the order quantity exceeds the sum of compartment capacities
                $totalCapacity = array_sum(array_column($allowedCompartments, 'capacity'));
                if ($amount > $totalCapacity) {
                    return false;
                }
            }
        }

        // Check if the order meets the minimum order quantity and minimum total order
        $minOrderQuantity = min(array_column($compartments, 'capacity'));
        $minTotalOrder = array_sum(array_column($compartments, 'capacity'));

        $orderTotal = array_sum(array_values($orderAmount));

        if ($orderTotal < $minOrderQuantity || $orderTotal > $minTotalOrder) {
            return false;
        }

        return true;
    }


}
