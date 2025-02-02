<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpotController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', [SpotController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    Route::put('/spot/{spot}', [SpotController::class, 'update'])->name('spot.update');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/spot', [SpotController::class, 'store'])->name('spot');

require __DIR__.'/auth.php';
