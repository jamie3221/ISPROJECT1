<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location; // Add this line to import the Location class

class LocationsTableSeeder extends Seeder
{
    public function run()
    {
        $locations = [
            'Westlands',
            'Kilimani',
            'Lavington',
            'Kileleshwa',
            'Karen',
            'Runda',
            'Parklands',
            'Ngong Road',
            'Upper Hill',
            'Langata',
            'Gigiri',
            'Muthaiga',
            'South B',
            'South C',
            'Embakasi',
            'Rongai',
            'Donholm',
            'Buruburu',
            'Kasarani',
            'Roysambu',
            'Githurai',
            'Kahawa Sukari',
            'Kahawa West',
            'Utawala',
            'Syokimau',
            'Mlolongo',
            'Kitengela',
            'Thika Road',
            'Juja',
            'Ruiru',
            'Kikuyu',
            'Dagoretti',
            'Ngara',
            'CBD'
        ];
    
        foreach ($locations as $location) {
            Location::create(['location_name' => $location]);
        }
    }
    
}
