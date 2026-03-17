<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayersSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = database_path('players.json');
        if (! file_exists($jsonPath)) {
            $this->command->error("Players JSON file not found at {$jsonPath}");
            return;
        }

        $json = file_get_contents($jsonPath);
        $players = json_decode($json, true);

        $rows = [];
        foreach ($players as $player) {
            $rows[] = [
                'team_id' => $player['team_id'] ?? null,
                'team' => $player['team'] ?? null,
                'photo_url' => $player['photo_url'] ?? $player['picture_url'] ?? null,
                'full_name' => $player['full_name'] ?? null,
                'college' => $player['college'] ?? null,
                'height' => $player['height'] ?? null,
                'weight' => $player['weight'] ?? null,
                'position' => $player['position'] ?? null,
                'jersey_number' => $player['jersey_number'] ?? null,
                'draft_year' => $player['draft_year'] ?? null,
                'draft_round' => $player['draft_round'] ?? null,
                'draft_number' => $player['draft_number'] ?? null,
                'country' => $player['country'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($rows)) {
            DB::table('players')->insert($rows);
            $this->command->info("Inserted " . count($rows) . " players.");
        }
    }
}
