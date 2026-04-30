<?php

namespace App\Http\Controllers\Barber;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\WorkingHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barber;
use App\Models\Appointment;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ScheduleExport;

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
            if($day->is_day_off) continue;

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
        
        $totalAppointmentsMinutes = $appointmentsForWeek->flatten()->sum(function($app){
            return Carbon::parse($app->start_time)->diffInMinutes(Carbon::parse($app->end_time));
        });

        $activeWorkTimePercentage = 0;
        if($weeklyHours > 0)
        {
            $activeWorkTimePercentage = round(($totalAppointmentsMinutes / $totalMinutes) * 100);
        }

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
            $wh = $schedules->get($date->dayOfWeek);
            $isDayOff = $wh->is_day_off;
            $weekDays[] = [
                'day_name' => $date->locale('sr')->translatedFormat('l'),
                'day_number' => $date->format('j'),
                'day_of_week' => $date->dayOfWeek,
                'is_today' => $date->isToday(),
                'wh_id' => $wh->id,
                'is_day_off' => $isDayOff,
                'start_time' => $isDayOff ? null : Carbon::parse($wh->start_time)->format('H:i'),
                'end_time'   => $isDayOff ? null : Carbon::parse($wh->end_time)->format('H:i'),
                'duration'   => $isDayOff ? '0h' : (function() use ($wh) {
                    $mins = Carbon::parse($wh->start_time)->diffInMinutes(Carbon::parse($wh->end_time));
                    return floor($mins / 60) . 'h' . ($mins % 60 > 0 ? ' ' . ($mins % 60) . 'm' : '');
                })(),
                'date' => $date,
            ];
        }
        return view('barber.schedule', compact('barber', 'schedules', 'workingDaysCount', 'notWorkingDays', 'weeklyHours', 'totalMinutes' ,'longestHours', 'appointmentsForWeek', 'revenueForWeek', 'weekDays', 'activeWorkTimePercentage'));
    }

    public function export()
    {
        $barber = Barber::where('user_id', Auth::id())->first();
    
        $workingHours = WorkingHour::where('barber_id', $barber->id)
            ->get()->keyBy('day_of_the_week');
    
        $appointmentsForWeek = Appointment::where('barber_id', $barber->id)
            ->whereBetween('start_time', [now()->startOfWeek(), now()->endOfWeek()])
            ->get()
            ->groupBy(fn($app) => $app->start_time->format('j'));
    
        $startOfWeek = now()->startOfWeek();
        $weekDays = [];
        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $weekDays[] = [
                'day_name'    => $date->locale('sr')->translatedFormat('l'),
                'day_number'  => $date->format('j'),
                'day_of_week' => $date->dayOfWeek,
                'is_today'    => $date->isToday(),
            ];
        }
    
        return Excel::download(
            new ScheduleExport($weekDays, $appointmentsForWeek, $workingHours),
            'raspored-' . now()->format('Y-m') . '.xlsx'
        );
    }

    public function updateAll(Request $request)
    {
        foreach($request->days as $id => $data)
        {

            WorkingHour::where('id', $id)->update([
                'is_day_off' => isset($data['is_day_off']),
                'start_time' => isset($data['is_day_off']) ? null : $data['start_time'],
                'end_time' => isset($data['is_day_off']) ? null : $data['end_time'],
            ]);
        }
        
        return redirect()->back()->with('success', 'Upsešno izmenjen raspored!');
    }

    public function update(Request $request, $id)
    {
        if(empty($request->start_time) or empty($request->end_time))
        {
            return redirect()->back()->with('error', 'Sva polja moraju biti popunjena!');
        }

        $workingHour = WorkingHour::findOrFail($id);
        $workingHour->is_day_off = $request->has('is_day_off');
        $workingHour->start_time = $request->start_time;
        $workingHour->end_time = $request->end_time;
        $workingHour->save();

        return redirect()->back()->with('success', 'Upsešno izmenjen dan!');
    }
}
