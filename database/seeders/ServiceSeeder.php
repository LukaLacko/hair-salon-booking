<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $service = new Service();
        $service->name = "Šišanje";
        $service->price = 800;
        $service->description = "Profesionalno šišanje prilagođeno željama klijenta.";
        $service->is_active = true;
        $service->duration_minutes = 60;
        $service->save();

        $service = new Service();
        $service->name = "Farbanje";
        $service->price = 1000;
        $service->description = "Bojenje kose kvalitetnim bojama za dugotrajne i sjajne rezultate.";
        $service->is_active = true;
        $service->duration_minutes = 60;
        $service->save();

        $service = new Service();
        $service->name = "Feniranje";
        $service->price = 800;
        $service->description = "Profesionalno sušenje i oblikovanje kose fenom.";
        $service->is_active = true;
        $service->duration_minutes = 60;
        $service->save();

        $service = new Service();
        $service->name = "Kreatin Tretman";
        $service->price = 5000;
        $service->description = "Dubinski tretman keratinom za zaglađivanje, jačanje i sjaj kose.";
        $service->is_active = true;
        $service->duration_minutes = 60;
        $service->save();

        $service = new Service();
        $service->name = "Mini val";
        $service->price = 6000;
        $service->description = "Trajno kovrčanje kose za prirodan i voluminozan izgled.";
        $service->is_active = true;
        $service->duration_minutes = 60;
        $service->save();

        $service = new Service();
        $service->name = "Pramenovi";
        $service->price = 4000;
        $service->description = "Tehnike bojenja pramenova za prirodan ili dramatičan efekat.";
        $service->is_active = true;
        $service->duration_minutes = 60;
        $service->save();

        $service = new Service();
        $service->name = "Ravnanje kose";
        $service->price = 700;
        $service->description = "Termičko ravnanje kose peglom za glatki i uredni izgled.";
        $service->is_active = true;
        $service->duration_minutes = 60;
        $service->save();

        $service = new Service();
        $service->name = "Loknanje kose";
        $service->price = 1000;
        $service->description = "Oblikovanje kovrdži i lokni uvijačem za efektan i romantičan stil.";
        $service->is_active = true;
        $service->duration_minutes = 60;
        $service->save();

        $service = new Service();
        $service->name = "Svečana frizura";
        $service->price = 2500;
        $service->description = "Elegantna i kreativna frizura za posebne prilike i događaje.";
        $service->is_active = true;
        $service->duration_minutes = 60;
        $service->save();

        $service = new Service();
        $service->name = "Pranje kose";
        $service->price = 500;
        $service->description = "Pranje kose profesionalnim šamponima i regeneratorima.";
        $service->is_active = true;
        $service->duration_minutes = 60;
        $service->save();

        $service = new Service();
        $service->name = "Trim brade";
        $service->price = 400;
        $service->description = "Precizno oblikovanje i uređivanje brade prema željenom stilu.";
        $service->is_active = true;
        $service->duration_minutes = 60;
        $service->save();

        $service = new Service();
        $service->name = "Brijanje brade";
        $service->price = 500;
        $service->description = "Klasično brijanje toplim peškirom i britvom za savršeno gladak rezultat.";
        $service->is_active = true;
        $service->duration_minutes = 60;
        $service->save();

        $service = new Service();
        $service->name = "Blanš";
        $service->price = 3500;
        $service->description = "Posvetljivanje kose oksidacijskim sredstvima za svjetlije tonove i efekat.";
        $service->is_active = true;
        $service->duration_minutes = 60;
        $service->save();


    }
}
