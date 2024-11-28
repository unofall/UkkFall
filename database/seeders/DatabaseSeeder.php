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
        "name" => "Naufal Tri",
        "username" => "Fall",
        "email" => "admin@gmail.com",
        "nohp" => "085624815963",
        "address" => "Spa",
        "level" => 1,
        "foto" => 'assets/img/admin.jpg',
        "password" => bcrypt("12345"),
       ]);

       User::create([
        "name" => "Tri",
        "username" => "y",
        "email" => "fal@gmail.com",
        "nohp" => "122121222",
        "address" => "Mrj",
        "level" => 2,
        "foto" => 'assets/img/member.jpeg',
        "password" => bcrypt("1234"),
       ]);

       Event::create([
        "name" => "Pengajian",
        "description" => "Mencari Anak Sholeh",
        "date" => "2024-11-26",
        "created_by" => 2,

       ]);


    }
}
