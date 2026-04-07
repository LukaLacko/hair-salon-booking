<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\BarberController as AdminBarberController;
use App\Http\Controllers\Admin\ClientController as AdminClientController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Barber\DashboardController as BarberDashboardController;


Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/usluge', [AdminServiceController::class, 'index'])->name('usluge');
    Route::get('/frizeri', [AdminBarberController::class, 'index'])->name('frizeri');
    Route::get('/termini', [AdminAppointmentController::class, 'index'])->name('termini');
    Route::get('/klijenti', [AdminClientController::class, 'index'])->name('klijenti');
});

Route::middleware(['auth', 'barber'])->prefix('barber')->name('barber.')->group(function(){
    Route::get('/dashboard', [BarberDashboardController::class, 'index'])->name('dashboard');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
