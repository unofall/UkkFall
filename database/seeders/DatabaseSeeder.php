<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       User::create([
        "name" => "Naufal",
        "username" => "Fall",
        "email" => "naufaltrir@gmail.com",
        "nohp" => "085624815963",
        "address" => "Spa",
        "level" => 1,
        "foto" => 'assets/img/profile.jpg',
        "password" => bcrypt("12345"),
       ]);

       User::create([
        "name" => "Nofal",
        "username" => "y",
        "email" => "yo@gmail.com",
        "nohp" => "122121222",
        "address" => "Mrj",
        "level" => 2,
        "foto" => '',
        "password" => bcrypt("1234"),
       ]);


    }
}
