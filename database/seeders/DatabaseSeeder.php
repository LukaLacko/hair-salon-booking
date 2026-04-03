<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            AppointmentSeeder::class,
        ]); 

        $this->call([
            BarberSeeder::class,
        ]); 

        $this->call([
            ClientSeeder::class,
        ]); 

        $this->call([
            RoleSeeder::class,
        ]); 
        
        $this->call([
            ServiceSeeder::class,
        ]); 

        $this->call([
            UserSeeder::class,
        ]); 

        $this->call([
            WorkingHourSeeder::class,
        ]); 
    }
}
