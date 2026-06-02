<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barber;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Client;

class BookingController extends Controller
{
    public function index()
    {
        $barbers = Barber::all();
        $services = Service::all();

        return view('booking', compact('barbers', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barber_id'  => 'required|exists:barbers,id',
            'service_id' => 'required|exists:services,id',
            'start_time' => 'required|date',
            'name'       => 'required|string',
            'phone'      => 'required|string',
            'email'      => 'nullable|email',
        ]);

        $client = Client::firstOrCreate(
            ['phone' => $request->phone],
            [
                'name'  => $request->name,
                'email' => $request->email,
            ]
        );

        // Izračunaj end_time na osnovu trajanja usluge
        $service   = \App\Models\Service::find($request->service_id);
        $startTime = \Carbon\Carbon::parse($request->start_time);
        $endTime   = $startTime->copy()->addMinutes($service->duration_minutes);

        Appointment::create([
            'barber_id'  => $request->barber_id,
            'client_id'  => $client->id,
            'service_id' => $request->service_id,
            'start_time' => $startTime,
            'end_time'   => $endTime,
            'price'      => $service->price,
            'status'     => 'Potvrđeno',
        ]);

        return redirect(route('welcome'))->with('success', 'Uspešno dodat termin!');
    }
}
