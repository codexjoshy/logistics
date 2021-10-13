<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name"=> "Admin Logistics", 
            "email"=> "info@booklogistic.com",
            "phone"=> "1234567890",
            "password"=> Hash::make('password'),
            "type"=> "admin",
        ]);
    }
}
