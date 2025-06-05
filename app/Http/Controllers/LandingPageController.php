<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('landing');
    }
    
    // API untuk mendapatkan data penerbangan (dummy untuk sekarang)
    public function getFlights()
    {
        $flights = [
            ['id' => 'flight001', 'lat' => -6.2146, 'lon' => 106.8451, 'alt' => 35000],
            ['id' => 'flight002', 'lat' => -6.9175, 'lon' => 107.6191, 'alt' => 36000]
        ];
        return response()->json($flights);
    }
    
}
