<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Barber;

class AppointmentController extends Controller
{
    public function index(Request $request)
    { 

        $date = $request->get('date');
        $barberId = $request->get('barber_id');
        $statusName = $request->get('status');

        $query = Appointment::with(['barber', 'service']);
        if ($date){
            $query->whereDate('start_time', $date);
        }
        
        if ($barberId){
            $query->where('barber_id', $barberId);
        }

        if ($statusName){
            $query->where('status', $statusName);
        }
 

        $appointments = $query->orderBy('start_time', 'desc')->get();

        $totalAppointmentsToday = Appointment::whereDate('start_time', now()->toDateString() )
            ->where('status', 'Potvrđeno')
            ->count();

        $confirmedAppointments = Appointment::where('status', 'Potvrđeno')
            ->count();

        $pendingAppointments = Appointment::where('status', 'Na čekanju')
            ->count();

        $todaysRevenue = Appointment::whereDate('start_time', now()->toDateString())
            ->where('status', 'Završeno')
            ->sum('price');

        $barbers = Barber::all();


        return view('admin.appointments', compact('appointments', 'totalAppointmentsToday', 'confirmedAppointments', 'pendingAppointments', 'todaysRevenue', 'barbers', 'date', 'barberId', 'statusName'));
    }
}
