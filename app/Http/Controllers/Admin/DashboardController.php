<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Barber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

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

        $last8Appointments = Appointment::with(['client', 'barber', 'service'])
            ->latest()
            ->take(8)
            ->get();

        $thisMonthProfit = Appointment::where('status', 'Završeno')
            ->whereMonth('end_time', now()->month)
            ->whereYear('end_time', now()->year)
            ->sum('price');

        $lastMonthProfit = Appointment::where('status', 'Završeno')
            ->whereMonth('end_time', now()->subMonth()->month)
            ->whereYear('end_time', now()->subMonth()->year)
            ->sum('price');

        $profitChange = 0;
        if ($lastMonthProfit > 0)
        {
            $profitChange = (($thisMonthProfit - $lastMonthProfit) / $lastMonthProfit) * 100;          
        }
        return view('admin.dashboard', compact("barbers", "appointments", "totalAppointments", "totalBarbers", "monthlyProfit", "monthlyAppointments", "lastAppointment", 'profitChange', 'last8Appointments', 'user'));
    }
}
