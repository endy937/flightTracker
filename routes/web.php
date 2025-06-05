 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\PersonnelController;


Route::get('/', function () {
    return view('home');
 });

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
});







Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/api/flights', [LandingPageController::class, 'getFlights']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
// Password Reset Routes
Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->middleware(['guest'])->name('password.request');
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->middleware(['guest'])->name('password.email');
Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->middleware(['guest'])->name('password.reset');
Route::post('reset-password', [NewPasswordController::class, 'store'])->middleware(['guest'])->name('password.update');



Route::resource('personnels', PersonnelController::class);
