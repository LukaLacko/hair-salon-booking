<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client = new Client();
        $client->name = 'Nikolina Tarzić';
        $client->email = 'nikolina@gmail.com';
        $client->phone= '063142312';
        $client->notes= 'Voli kratku kosu i ima mačku ljubimca koji se zove Arnold';

        $client = new Client();
        $client->name = 'Milan Mitrije';
        $client->email = 'milan@gmail.com';
        $client->phone= '061423161';
        $client->notes= 'Ima dva brata i sestru';

        $client = new Client();
        $client->name = 'Nada Demiter';
        $client->email = 'nada@gmail.com';
        $client->phone= '063142312';
        $client->notes= 'Presla pre kod nas na šišanje zbog lošeg iskustva sa frizerima u drugoj firmi!';
        
        $client = new Client();
        $client->name = 'Bane Lazerovac';
        $client->email = 'bane@gmail.com';
        $client->phone= '06465219';
        $client->notes= '';
        
    }
}
