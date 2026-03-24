<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Šeit tiek izsaukti citi seederi, lai aizpildītu datubāzi ar sākotnējiem datiem
        $this->call([
            PlayersSeeder::class,
            TeamsSeeder::class,
        ]);
    }
}
