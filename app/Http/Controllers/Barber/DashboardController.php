<?php

namespace App\Http\Controllers\Barber;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barber;
use Illuminate\Support\Facades\App;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $barber = Barber::where('user_id', $user->id)->first();
        $barberId = $barber->id;


        $appointmentsToday = Appointment::with(['client' => function($q) {
                $q->withTrashed();
            }])
            ->where('barber_id', $barberId) 
            ->whereDate('start_time', now()->toDateString())
            ->orderBy('start_time', 'asc')
            ->get();

        $upNextAppointment = Appointment::where('barber_id', $barberId)
            ->with(['client', 'barber', 'service'])
            ->where('status', 'Potvrđeno')
            ->where('start_time', '>', now())
            ->orderBy('start_time', 'asc')
            ->first();

        $appointmentsFinishedToday = Appointment::where('barber_id', $barberId)
            ->where('status', 'Završeno')
            ->whereDate('end_time', today())
            ->count();
            
        $appointmentsFinishedThisWeek = Appointment::where('barber_id', $barberId)
            ->where('status', 'Završeno')
            ->whereDate('end_time', '>=', now()->startOfWeek())
            ->count();

        $yesterdaysRevenue = Appointment::where('barber_id', $barberId)
            ->where('status', 'Završeno')
            ->whereDate('end_time', now()->subDay())
            ->sum('price');

        $todaysRevenue = Appointment::where('barber_id', $barberId)
        ->where('status', 'Završeno')
        ->whereDate('end_time', today())
        ->sum('price');

        $thisWeeksRevenue = Appointment::where('barber_id', $barberId)
            ->where('status', 'Završeno')
            ->whereDate('end_time', '>=', now()->startOfWeek())
            ->sum('price');

        $revenueChange = 0;

        if ($yesterdaysRevenue > 0) {
            $revenueChange = (($todaysRevenue - $yesterdaysRevenue) / $yesterdaysRevenue) * 100;
        } elseif ($todaysRevenue > 0) {
            $revenueChange = 100;
        } else {
            $revenueChange = 0;
        }
        
        $revenueChange = round($revenueChange, 1);

        $startOfWeek = now()->startOfWeek();
        $weekDays = [];

        for($i = 0; $i < 7; $i++)
        {
            $date = $startOfWeek->copy()->addDays($i);
            $weekDays[] = [
              'day_name' => $date->locale('sr')->translatedFormat('l'),
              'day_number' => $date->format('j'),
              'is_today' => $date->isToday(),  
            ];
        }

        $appointmentsForWeek = Appointment::whereBetween('start_time', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])
        ->with('client', 'barber')
        ->get();




        return view('barber.dashboard', compact('barber', 'appointmentsToday', 'appointmentsFinishedToday', 'todaysRevenue', 'revenueChange', 'appointmentsFinishedThisWeek', 'thisWeeksRevenue', 'upNextAppointment', 'weekDays', 'appointmentsForWeek'));
    }

    public function complete($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'Završeno';
        $appointment->save();

        return redirect()->back()->with('success', 'Uspešno završen termin!');

    }

    public function cancel($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'Otkazano';
        $appointment->save();

        return redirect()->back()->with('success', 'Uspešno otkazan termin');
    }
}
