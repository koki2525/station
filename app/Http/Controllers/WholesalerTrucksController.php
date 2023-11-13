<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Models\Station;

class WholesalerTrucksController extends Controller
{
    public function index()
    {
        $wholesalerTrucks = json_decode(File::get(public_path('wholesaler_trucks.json')), true);
        $station = Station::where('user_id', auth()->user()->id)->first();

        return view('home', compact('wholesalerTrucks', 'station'));
    }
}
