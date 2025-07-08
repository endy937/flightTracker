<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdsbController;

Route::post('/save-adsb', [AdsbController::class, 'store']);


