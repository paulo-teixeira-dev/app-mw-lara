<?php

namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::create([
            "nome" => "Paulo Ananias",
            "sobrenome" => "Teixeira",
            "email" => "localdev@example.com",
            "password" => "123456789",
        ]);
    }
}
