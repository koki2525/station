<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Station;

class PagesController extends Controller
{
    public function index()
    {
        $json = file_get_contents(public_path('station.json'));
        $data = json_decode($json, true);

        // Extract station data (assuming one station for simplicity)
        $stationData = $data['stations'][0];

        // Prepare chart data
        $labels = ['ULP93', 'ULP95', 'Diesel'];
        $capacities = [
            $stationData['ulp93_capacity'],
            $stationData['ulp95_capacity'],
            $stationData['diesel_capacity'],
        ];
        $stocks = [
            $stationData['ulp93_stock'],
            $stationData['ulp95_stock'],
            $stationData['diesel_stock'],
        ];

        $sales = [
            $stationData['ulp93_sales'],
            $stationData['ulp95_sales'],
            $stationData['diesel_sales'],
        ];

        return view('home',compact('labels', 'capacities', 'stocks', 'sales'));
    }
    public function trucks()
    {
        $wholesalerTrucks = json_decode(File::get(public_path('wholesaler_trucks.json')), true);
        return view('pages.wholesaler-trucks', compact('wholesalerTrucks'));
    }

    public function stock()
    {
        $station = Station::where('user_id', auth()->user()->id)->first();
        return view('pages.stock-levels', compact('station'));
    }

    public function stationDetails()
    {
        $station = Station::where('user_id', auth()->user()->id)->first();

        return view('pages.station-details',compact('station'));
    }
}
