<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SystemAdministrator;
use Illuminate\Support\Facades\Hash; // Add this line to import the Hash class

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SystemAdministrator::create([
            'admin_name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Change the password as needed
        ]);
    }
}
