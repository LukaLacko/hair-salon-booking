<?php

namespace App\Http\Controllers\Barber;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Barber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $barber = Barber::where('user_id', $user->id)->first();
        $barberId = $barber->id;

        $threeAppointments = Appointment::where('barber_id', $barberId)
            ->where('status', 'Završeno')
            ->with('client')
            ->with('service')
            ->orderBy('start_time', 'desc')
            ->get()
            ->groupBy('client_id')
            ->map(fn($apps) => $apps->take(3))
            ->flatten();

        $allClients = Appointment::where('barber_id', $barberId)
            ->with('service')
            ->with(['client.nextAppointment'])
            ->selectRaw("client_id, 
                        SUM(status = 'Završeno') as total_visits, 
                        SUM(IF(status = 'Završeno', price, 0)) as total_spent, 
                        MAX(IF(status = 'Završeno', end_time, NULL)) as last_visit_date, 
                        AVG(IF(status = 'Završeno', price, NULL)) as avg_spent, 
                        SUM(status = 'Otkazano') as total_canceled")
            ->groupBy('client_id')
            ->paginate(6);


        $myTotalClients = Appointment::where('barber_id', $barberId)
            ->where('status', 'Završeno')
            ->distinct('client_id')
            ->count('client_id');

        $newClientsThisMonth = Appointment::where('barber_id', $barberId)
            ->whereMonth('created_at', now()->month)
            ->whereIn('client_id', function($query) use ($barberId) {
                $query->select('client_id')
                    ->from('appointments')
                    ->where('barber_id', $barberId)
                    ->groupBy('client_id')
                    ->havingRaw('MIN(created_at) >= ?', [now()->startOfMonth()]);
            })
            ->select('client_id')
            ->distinct()
            ->get();

        $newClientsThisMonthCount = Appointment::where('barber_id', $barberId)
            ->whereMonth('created_at', now()->month)
            ->whereIn('client_id', function($query) use ($barberId) {
                $query->select('client_id')
                    ->from('appointments')
                    ->where('barber_id', $barberId)
                    ->groupBy('client_id')
                    ->havingRaw('MIN(created_at) >= ?', [now()->startOfMonth()]);
            })
            ->distinct('client_id')
            ->count('client_id');



        $vipClients = Appointment::where('barber_id', $barberId)
        // spent more than 15000din this month or has more than 3 visits this month
            ->with('client')
            ->whereMonth('end_time', now()->month)
            ->whereYear('end_time', now()->year)
            ->where('status', 'Završeno')
            ->selectRaw('client_id, SUM(price) as totalSpent, COUNT(*) as visit_count ')
            ->groupBy('client_id')
            ->havingRaw('SUM(price) >= 15000 OR COUNT(*) >= 3')
            ->get();
        
        $activeClients = Appointment::where('barber_id', $barberId)
        // had an a appointment this month
            ->whereMonth('end_time', now()->month)
            ->whereYear('end_time', now()->year)
            ->where('status', 'Završeno')
            ->with('client')
            ->select('client_id')
            ->distinct()
            ->get();
            
        $countActiveClientsThisMonth = Appointment::where('barber_id', $barberId)
            ->whereMonth('end_time', now()->month)
            ->whereYear('end_time', now()->year)
            ->where('status', 'Završeno')
            ->distinct()
            ->count('client_id');
        
        $activeClientsPercentage = 0;
        if($myTotalClients > 0)
        {
            $activeClientsPercentage = ($countActiveClientsThisMonth / $myTotalClients) * 100;
        }

        $activeClientsPercentage = round($activeClientsPercentage, 1);
        

        $riskyClients = Appointment::where('barber_id', $barberId)
            ->where('status', 'Završeno')
            ->selectRaw('client_id, MAX(end_time) as last_visit')
            ->groupBy('client_id')
            ->having('last_visit', '<', now()->subDays(60))
            ->with('client')
            ->get();
        
        $inactiveClients = Appointment::where('barber_id', $barberId)
            ->where('status', 'Završeno')
            ->selectRaw('client_id, MAX(end_time) as last_visit')
            ->groupBy('client_id')
            ->having('last_visit', '<', now()->subDays(120))
            ->with('client')
            ->get();



        $bestClientThisMonth = Appointment::where('barber_id', $barberId)
            ->whereMonth('end_time', now()->month)
            ->whereYear('end_time', now()->year)
            ->where('status', 'Završeno')
            ->with('client')
            ->selectRaw('client_id, SUM(price) as total_spent, COUNT(*) as total_visits')
            ->groupBy('client_id')
            ->orderByDesc('total_spent')
            ->first();

        return view('barber.clients', compact('barber', 'threeAppointments','allClients', 'myTotalClients', 'newClientsThisMonth', 'newClientsThisMonthCount', 'vipClients', 'activeClients', 'countActiveClientsThisMonth', 'activeClientsPercentage', 'riskyClients', 'inactiveClients', 'bestClientThisMonth'));
    }
}
