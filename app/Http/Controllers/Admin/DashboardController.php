<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Barber;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $barbers = Barber::withCount('appointments')
            ->withSum('appointments as total_profit', 'price')
            ->get();
        $appointments = Appointment::all();

        $totalBarbers = Barber::count();

        $totalAppointments = Appointment::count();
        $monthlyAppointments = Appointment::whereMonth('end_time', now()->month)
            ->whereYear('end_time', now()->year)
            ->count();

        $monthlyProfit = Appointment::whereMonth('end_time', now()->month)
            ->whereYear('end_time', now()->year)
            ->sum('price');

        $lastAppointment = Appointment::where('end_time', '<=', now())
            ->orderBy('end_time', 'desc')
            ->first();


        return view('admin.dashboard', compact("barbers", "appointments", "totalAppointments", "totalBarbers", "monthlyProfit", "monthlyAppointments", "lastAppointment"));
    }
}
