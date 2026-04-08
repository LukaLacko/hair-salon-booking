<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barber;

class BarberController extends Controller
{
    public function index()
    {
        $barbers = Barber::with('workingHours')->get();
        $totalBarbers = $barbers->count();

        

        return view('admin.barbers', compact('barbers', 'totalBarbers'));
    }
}
