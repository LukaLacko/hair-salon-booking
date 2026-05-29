<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barber;
use App\Models\Service;

class BookingController extends Controller
{
    public function index()
    {
        $barbers = Barber::all();
        $services = Service::all();

        return view('booking', compact('barbers', 'services'));
    }

    public function store()
    {
        return view('booking');
    }
}
