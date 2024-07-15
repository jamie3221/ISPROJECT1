<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Add this line to import the Hash class
use App\Models\Customer; // Add this line to import the Customer class

class CustomerSeeder extends Seeder
{
    public function run()
    {
        Customer::create([
            'first_name' => 'Emily',
            'middle_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'emily.smith@example.com',
            'phone_number' => '555111222',
            'password' => bcrypt('password789'),
            'profile_picture' => 'profile3.jpg',
        ]);
    }
}
