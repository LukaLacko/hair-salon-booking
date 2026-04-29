<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Carbon\Carbon;

class ScheduleExport implements FromCollection, WithHeadings
{
    public function __construct(
        private $weekDays,
        private $appointmentsForWeek,
        private $workingHours
    ){}

    public function headings(): array
    {
        return ['Dan', 'Početak', 'Kraj', 'Trajanje', 'Zakazano Termina'];
    }
    public function collection()
    {
        return collect($this->weekDays)->map(function($day){
            $wh = $this->workingHours->get($day['day_of_week']);
            $apps = $this->appointmentsForWeek->get($day['day_number'], collect());
            $isDayOff = !$wh || $wh->is_day_off;

            $trajanje = '0h';
            if (!$isDayOff) {
                $start = Carbon::parse($wh->start_time);
                $end = Carbon::parse($wh->end_time);
                $mins = $start->diffInMinutes($end);
                $trajanje = floor($mins / 60) . 'h' . ($mins % 60 > 0 ? ' ' . ($mins % 60) . 'm' : '');        
            }

            return [
                'dan' => ucfirst($day['day_name']),
                'pocetak' => $isDayOff ? '--:--' : Carbon::parse($wh->start_time)->format('H:i'),
                'kraj' => $isDayOff ? '--:--' : Carbon::parse($wh->end_time)->format('H:i'),
                'trajanje' => $trajanje,
                'termini' => $apps->count(),
            ];
        }); 
    }
}
