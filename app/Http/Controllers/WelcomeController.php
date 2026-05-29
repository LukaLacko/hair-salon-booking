<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barber;


class WelcomeController extends Controller
{
    public function index()
    {

        $barbers = Barber::paginate(3);

        return view('welcome', compact('barbers'));
    }
}
