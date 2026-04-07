<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $barbers = Barber::all();

        return view('admin.dashboard', compact("barbers"));
    }
}
