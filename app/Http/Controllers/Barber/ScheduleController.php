<?php

namespace App\Http\Controllers\Barber;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\WorkingHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barber;
use App\Models\Appointment;


class ScheduleController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        $barber = Barber::where('user_id', $user->id)->first();
        $barberId = $barber->id;


        $schedules = WorkingHour::where('barber_id', $barberId)
            ->with('barber')
            ->get()
            ->keyBy('day_of_the_week');

        $workingDaysCount = WorkingHour::where('barber_id', $barberId)
            ->where('is_day_off', false)
            ->count();

        $notWorkingDays = 7 - $workingDaysCount;

        $totalMinutes = 0;
        $longestDayMinutes = 0;
        foreach($schedules as $day)
        {
            $start = Carbon::parse($day->start_time);
            $end = Carbon::parse($day->end_time);

            $duration = $start->diffInMinutes($end);
            $totalMinutes += $duration;
            if($longestDayMinutes < $duration)
            {
                $longestDayMinutes = $duration;
            }
        }

        $weeklyHours = floor($totalMinutes/60);

        $longestHours = floor($longestDayMinutes/60);

        $appointmentsForWeek = Appointment::where('barber_id', $barberId)
            ->whereBetween('start_time', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])
            ->get()
            ->groupBy(function($app){
                return $app->start_time->format('j');
            });

        $revenueForWeek = Appointment::where('barber_id', $barberId)
            ->whereBetween('start_time', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])
            ->where('status', 'Potvrđeno')
            ->sum('price');
        
        $startOfWeek = now()->startOfWeek();
        $weekDays = [];

        for($i = 0; $i < 7; $i++)
        {
            $date = $startOfWeek->copy()->addDays($i);
            $weekDays[] = [
                'day_name' => $date->locale('sr')->translatedFormat('l'),
                'day_number' => $date->format('j'),
                'day_of_week' => $date->dayOfWeek,
                'is_today' => $date->isToday(),
            ];
        }




        return view('barber.schedule', compact('barber', 'schedules', 'workingDaysCount', 'notWorkingDays', 'weeklyHours', 'totalMinutes' ,'longestHours', 'appointmentsForWeek', 'revenueForWeek', 'weekDays'));
    }
}
