<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barber;

class BarberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barber = new Barber();
        $barber->user_id = 2;
        $barber->name = 'Miloš Milosević';
        $barber->bio = "Miloš je završio frizersku školu i ima puno iskustva jer celog svog života se bavi ovim poslom.";
        $barber->photo = '';
        $barber->is_available = 1;

        $barber = new Barber();
        $barber->user_id = 2;
        $barber->name = 'Ana Panković';
        $barber->bio = "Ana je završila frizersku obuku u Londonu i ima puno iskustva jer celog svog života se bavi ovim poslom.";
        $barber->photo = '';
        $barber->is_available = 1;

    }
}
