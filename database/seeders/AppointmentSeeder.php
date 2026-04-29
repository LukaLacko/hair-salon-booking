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
        $appointment->status = 'Završeno';
        $appointment->notes = null;
        $appointment->price = 1000;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 2;
        $appointment->client_id = 2;
        $appointment->service_id = 5;
        $appointment->start_time = '2026-04-02 14:00:00';
        $appointment->end_time = '2026-04-02 15:30:00';
        $appointment->status = 'Završeno';
        $appointment->notes = 'Klijent želi da ostane ista dužina kose.';
        $appointment->price = 6000;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 2;
        $appointment->client_id = 3;
        $appointment->service_id = 1;
        $appointment->start_time = '2026-04-19 09:30:00';
        $appointment->end_time = '2026-04-19 10:30:00';
        $appointment->status = 'Završeno';
        $appointment->notes = null;
        $appointment->price = 800;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 2;
        $appointment->client_id = 2;
        $appointment->service_id = 3;
        $appointment->start_time = '2026-04-20 09:30:00';
        $appointment->end_time = '2026-04-20 10:30:00';
        $appointment->status = 'Završeno';
        $appointment->notes = null;
        $appointment->price = 1500;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 2;
        $appointment->client_id = 4;
        $appointment->service_id = 6;
        $appointment->start_time = '2026-04-10 15:30:00';
        $appointment->end_time = '2026-04-10 16:00:00';
        $appointment->status = 'Potvrđeno';
        $appointment->notes = null;
        $appointment->price = 4000;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 2;
        $appointment->client_id = 4;
        $appointment->service_id = 6;
        $appointment->start_time = '2026-04-18 15:30:00';
        $appointment->end_time = '2026-04-18 16:00:00';
        $appointment->status = 'Završeno';
        $appointment->notes = null;
        $appointment->price = 4000;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 1;
        $appointment->client_id = 3;
        $appointment->service_id = 1;
        $appointment->start_time = '2026-3-20 11:30:00';
        $appointment->end_time = '2026-03-20 12:00:00';
        $appointment->status = 'Završeno';
        $appointment->notes = null;
        $appointment->price = 500;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 3;
        $appointment->client_id = 3;
        $appointment->service_id = 7;
        $appointment->start_time = '2026-3-10 11:30:00';
        $appointment->end_time = '2026-03-10 12:00:00';
        $appointment->status = 'Potvrđeno';
        $appointment->notes = null;
        $appointment->price = 1200;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 3;
        $appointment->client_id = 1;
        $appointment->service_id = 4;
        $appointment->start_time = '2026-4-9 11:30:00';
        $appointment->end_time = null;
        $appointment->status = 'Na čekanju';
        $appointment->notes = null;
        $appointment->price = 1000;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 3;
        $appointment->client_id = 1;
        $appointment->service_id = 4;
        $appointment->start_time = '2026-4-9 13:30:00';
        $appointment->end_time = '2026-4-9 14:30:00';
        $appointment->status = 'Završeno';
        $appointment->notes = null;
        $appointment->price = 1500;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 4;
        $appointment->client_id = 2;
        $appointment->service_id = 1;
        $appointment->start_time = '2026-4-5 13:30:00';
        $appointment->end_time = '2026-4-5 14:30:00';
        $appointment->status = 'Završeno';
        $appointment->notes = null;
        $appointment->price = 1200;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 1;
        $appointment->client_id = 2;
        $appointment->service_id = 6;
        $appointment->start_time = '2026-4-21 17:30:00';
        $appointment->end_time = '2026-4-21 18:30:00';
        $appointment->status = 'Potvrđeno';
        $appointment->notes = null;
        $appointment->price = 1200;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 1;
        $appointment->client_id = 2;
        $appointment->service_id = 2;
        $appointment->start_time = '2026-4-21 11:00:00';
        $appointment->end_time = '2026-4-21 11:30:00';
        $appointment->status = 'Završeno';
        $appointment->notes = null;
        $appointment->price = 2000;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 1;
        $appointment->client_id = 3;
        $appointment->service_id = 1;
        $appointment->start_time = '2026-4-21 14:00:00';
        $appointment->end_time = '2026-4-21 18:30:00';
        $appointment->status = 'Potvrđeno';
        $appointment->notes = null;
        $appointment->price = 800;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 1;
        $appointment->client_id = 3;
        $appointment->service_id = 1;
        $appointment->start_time = '2026-4-25 20:00:00';
        $appointment->end_time = '2026-4-25 20:30:00';
        $appointment->status = 'Potvrđeno';
        $appointment->notes = null;
        $appointment->price = 800;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 1;
        $appointment->client_id = 3;
        $appointment->service_id = 1;
        $appointment->start_time = '2026-4-25 11:00:00';
        $appointment->end_time = '2026-4-25 11:30:00';
        $appointment->status = 'Završeno';
        $appointment->notes = null;
        $appointment->price = 1000;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 1;
        $appointment->client_id = 1;
        $appointment->service_id = 6;
        $appointment->start_time = '2026-4-25 10:00:00';
        $appointment->end_time = '2026-4-25 10:30:00';
        $appointment->status = 'Završeno';
        $appointment->notes = null;
        $appointment->price = 1500;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 1;
        $appointment->client_id = 1;
        $appointment->service_id = 2;
        $appointment->start_time = '2026-4-25 21:00:00';
        $appointment->end_time = '2026-4-25 21:30:00';
        $appointment->status = 'Potvrđeno';
        $appointment->notes = null;
        $appointment->price = 2000;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 1;
        $appointment->client_id = 1;
        $appointment->service_id = 2;
        $appointment->start_time = '2026-4-27 10:00:00';
        $appointment->end_time = '2026-4-27 10:30:00';
        $appointment->status = 'Završeno';
        $appointment->notes = null;
        $appointment->price = 2000;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 1;
        $appointment->client_id = 2;
        $appointment->service_id = 5;
        $appointment->start_time = '2026-4-27 11:00:00';
        $appointment->end_time = '2026-4-27 11:30:00';
        $appointment->status = 'Potvrđeno';
        $appointment->notes = null;
        $appointment->price = 1000;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 1;
        $appointment->client_id = 1;
        $appointment->service_id = 3;
        $appointment->start_time = '2026-4-27 17:00:00';
        $appointment->end_time = '2026-4-27 18:30:00';
        $appointment->status = 'Potvrđeno';
        $appointment->notes = null;
        $appointment->price = 3000;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 1;
        $appointment->client_id = 3;
        $appointment->service_id = 2;
        $appointment->start_time = '2026-4-28 9:00:00';
        $appointment->end_time = '2026-4-28 10:00:00';
        $appointment->status = 'Potvrđeno';
        $appointment->notes = null;
        $appointment->price = 1500;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 1;
        $appointment->client_id = 2;
        $appointment->service_id = 2;
        $appointment->start_time = '2026-4-29 9:00:00';
        $appointment->end_time = '2026-4-29 10:00:00';
        $appointment->status = 'Potvrđeno';
        $appointment->notes = null;
        $appointment->price = 1300;
        $appointment->save();


        $appointment = new Appointment();
        $appointment->barber_id = 1;
        $appointment->client_id = 2;
        $appointment->service_id = 8;
        $appointment->start_time = '2026-4-29 14:00:00';
        $appointment->end_time = '2026-4-29 14:30:00';
        $appointment->status = 'Potvrđeno';
        $appointment->notes = null;
        $appointment->price = 2500;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 1;
        $appointment->client_id = 2;
        $appointment->service_id = 8;
        $appointment->start_time = '2026-4-30 10:00:00';
        $appointment->end_time = '2026-4-30 11:30:00';
        $appointment->status = 'Potvrđeno';
        $appointment->notes = null;
        $appointment->price = 2500;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 1;
        $appointment->client_id = 4;
        $appointment->service_id = 8;
        $appointment->start_time = '2026-5-1 10:00:00';
        $appointment->end_time = '2026-5-1 11:30:00';
        $appointment->status = 'Potvrđeno';
        $appointment->notes = null;
        $appointment->price = 2500;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->barber_id = 1;
        $appointment->client_id = 2;
        $appointment->service_id = 3;
        $appointment->start_time = '2026-4-27 18:00:00';
        $appointment->end_time = '2026-4-27 18:30:00';
        $appointment->status = 'Potvrđeno';
        $appointment->notes = null;
        $appointment->price = 3000;
        $appointment->save();



    }
}
