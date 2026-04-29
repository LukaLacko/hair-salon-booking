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
use App\Http\Controllers\Barber\ScheduleController as BarberScheduleController;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // SERVICES
    Route::post('/usluge/dodaj', [AdminServiceController::class, 'store'])->name('dodaj');
    Route::get('/usluge', [AdminServiceController::class, 'index'])->name('usluge');
    Route::put('/usluge/izmeni/{id}', [AdminServiceController::class, 'update'])->name('izmeni');
    Route::delete('/usluge/obrisi/{id}', [AdminServiceController::class, 'destroy'])->name('obrisi');

    //Barbers
    Route::get('/frizeri', [AdminBarberController::class, 'index'])->name('frizeri');
    Route::delete('/frizeri/obrisi/{id}', [AdminBarberController::class, 'destroy'])->name('obrisi');
    Route::post('/frizeri/dodaj', [AdminBarberController::class, 'store'])->name('dodaj');
    Route::put('/frizeri/izmeni/{id}', [AdminBarberController::class, 'update'])->name('izmeni');

    // Appointments
    Route::get('/termini', [AdminAppointmentController::class, 'index'])->name('termini');
    Route::post('/termini/dodaj', [AdminAppointmentController::class, 'store'])->name('dodaj');
    Route::get('/termini/potvrdi/{id}', [AdminAppointmentController::class, 'confirm'])->name('potvrdi');
    Route::get('/termini/završi/{id}', [AdminAppointmentController::class, 'completed'])->name('završi');
    Route::put('/termini/izmeni/{id}', [AdminAppointmentController::class, 'store'])->name('izmeni');
    Route::delete('/termini/obrisi/{id}', [AdminAppointmentController::class, 'destroy'])->name('obrisi');


    Route::get('/klijenti', [AdminClientController::class, 'index'])->name('klijenti');
    Route::post('/klijenti/dodaj', [AdminClientController::class, 'store'])->name('dodaj');
    Route::delete('/klijenti/obrisi/{id}', [AdminClientController::class, 'destroy'])->name('obrisi');
    Route::put('/klijenti/izmeni/{id}', [AdminClientController::class, 'update'])->name('izmeni');
});

Route::middleware(['auth', 'barber'])->prefix('barber')->name('barber.')->group(function(){
    Route::get('/dashboard', [BarberDashboardController::class, 'index'])->name('dashboard');
    Route::patch('/dashboard/završi/{id}', [BarberDashboardController::class, 'complete'])->name('završi');
    Route::patch('/dashboard/otkaži/{id}', [BarberDashboardController::class, 'cancel'])->name('otkaži');

    Route::get('/raspored', [BarberScheduleController::class, 'index'])->name('raspored');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
