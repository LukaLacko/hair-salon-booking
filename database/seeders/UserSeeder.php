<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = "Nikola Nikolić";
        $user->email = "nikola@gmail.com";
        $user->password = Hash::make('nikola');
        $user->role_id = 1;
        $user->save();

        $user = new User();
        $user->name = "Miloš Milosević";
        $user->email = "milos@gmail.com";
        $user->password = Hash::make('milos');
        $user->role_id = 2;
        $user->save();

        $user = new User();
        $user->name = "Ana Panković";
        $user->email = "ana@gmail.com";
        $user->password = Hash::make('ana');
        $user->role_id = 2;
        $user->save();
        
    }
}
