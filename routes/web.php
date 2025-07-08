 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdsbController;

Route::get('/', function () {
    return view('home');
});