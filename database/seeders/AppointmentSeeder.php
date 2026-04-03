<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Appointment;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $appointment = new Appointment();
        $appointment->barber_id = 1;
        $appointment->client_id = 1;
        $appointment->service_id = 1;
        $appointment->start_time = '2026-04-01 14:00:00';
        $appointment->end_time = '2026-04-01 14:30:00';
        $appointment->status = 'Zavšeno';
        $appointment->notes = null;
        $appointment->price = 1000;

        $appointment = new Appointment();
        $appointment->barber_id = 2;
        $appointment->client_id = 2;
        $appointment->service_id = 5;
        $appointment->start_time = '2026-04-02 14:00:00';
        $appointment->end_time = '2026-04-02 13:30:00';
        $appointment->status = 'Zavšeno';
        $appointment->notes = 'Klijent želi da ostane ista dužina kose.';
        $appointment->price = 1500;

        $appointment = new Appointment();
        $appointment->barber_id = 2;
        $appointment->client_id = 3;
        $appointment->service_id = 1;
        $appointment->start_time = '2026-04-15 09:30:00';
        $appointment->end_time = '2026-04-15 10:30:00';
        $appointment->status = 'Na čekanju';
        $appointment->notes = null;
        $appointment->price = 1200;

        $appointment = new Appointment();
        $appointment->barber_id = 2;
        $appointment->client_id = 4;
        $appointment->service_id = 1;
        $appointment->start_time = '2026-04-10 15:30:00';
        $appointment->end_time = '2026-04-10 16:00:00';
        $appointment->status = 'Potvrđeno';
        $appointment->notes = null;
        $appointment->price = 1200;
    }
}
