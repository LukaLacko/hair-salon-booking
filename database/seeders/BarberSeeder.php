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
        $barber->photo = 'barber_id1.webp';
        $barber->is_available = true;
        $barber->save();

        $barber = new Barber();
        $barber->user_id = 3;
        $barber->name = 'Ana Panković';
        $barber->bio = "Ana je završila frizersku obuku u Londonu i ima puno iskustva jer celog svog života se bavi ovim poslom.";
        $barber->photo = 'barber_id2.webp';
        $barber->is_available = true;
        $barber->save();

        $barber = new Barber();
        $barber->user_id = 4;
        $barber->name = 'Nadežda Dimitrijević';
        $barber->bio = "Nadežda sa svojom sjajnom poslovnom etikom osvojila 2. mesto u takmičenju frizeraja.";
        $barber->photo = 'barber_id3.webp';
        $barber->is_available = true;
        $barber->save();

        $barber = new Barber();
        $barber->user_id = 5;
        $barber->name = 'Marija Marković';
        $barber->bio = "";
        $barber->photo = 'barber_id4.webp';
        $barber->is_available = true;
        $barber->save();

    }
}
