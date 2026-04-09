<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Barber;
use App\Models\Client;
use App\Models\Service;
use Carbon\Carbon;


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

        $clients = Client::all();

        $services = Service::all();


        return view('admin.appointments', compact('appointments', 'totalAppointmentsToday', 'confirmedAppointments', 'pendingAppointments', 'todaysRevenue', 'barbers', 'date', 'barberId', 'statusName', 'clients', 'services'));
    }

    public function store(Request $request)
    {
        if(empty($request->barber_id) || empty($request->client_id) || empty($request->service_id) || empty($request->start_time) || empty($request->status) || empty($request->price))
        {
            return redirect()->back()->with('error', 'Morate popuniti sva obavezna polja!');
        }

        $start = Carbon::parse($request->start_date . ' ' . $request->start_time);
        $end = Carbon::parse($request->end_date . ' ' . $request->end_time);

        $appointment = new Appointment();
        $appointment->barber_id = $request->barber_id;
        $appointment->client_id = $request->client_id;
        $appointment->service_id = $request->service_id;
        $appointment->start_time = $start;
        $appointment->end_time = $end;
        $appointment->status = $request->status;
        $appointment->notes = $request->notes;
        $appointment->price = $request->price;
        $appointment->save();

        return redirect()->back()->with('success', 'Uspešno zakazan novi termin!');
    }

    public function confirm($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'Potvrđeno';
        $appointment->save();

        return redirect()->back()->with('success', 'Uspešno potvrđen termin!');
    }
}
