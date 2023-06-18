<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Marca;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        /** independentes **/

        Marca::insert([
            ['nome' => 'Electrolux'],
            ['nome' => 'Brastemp'],
            ['nome' => 'Fischer'],
            ['nome' => 'Samsung'],
            ['nome' => 'LG'],
        ]);
    }
}
