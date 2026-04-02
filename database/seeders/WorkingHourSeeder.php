<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WorkingHour;

class WorkingHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = [
            ['day' => 0, 'off' => true, 'start' => null, 'end' => null],
            ['day' => 1, 'off' => false, 'start' => '09:00', 'end' => '17:00'],
            ['day' => 2, 'off' => false, 'start' => '09:00', 'end' => '17:00'],
            ['day' => 3, 'off' => false, 'start' => '09:00', 'end' => '17:00'],
            ['day' => 4, 'off' => false, 'start' => '09:00', 'end' => '17:00'],
            ['day' => 5, 'off' => false, 'start' => '09:00', 'end' => '17:00'],
            ['day' => 6, 'off' => true, 'start' => null, 'end' => null],
        ];

        foreach($days as $day)
        {
            WorkingHour::create([
                'barber_id' => 1,
                'day_of_the_week' => $day['day'],
                'start_time' => $day['start'],
                'end_time' => $day['end'],
                'is_day_off' => $day['off']
            ]);
        }

        foreach($days as $day)
        {
            WorkingHour::create([
                'barber_id' => 2,
                'day_of_the_week' => $day['day'],
                'start_time' => $day['start'],
                'end_time' => $day['end'],
                'is_day_off' => $day['off']
            ]);
        }

    }
}
