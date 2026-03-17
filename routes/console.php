<?php

use App\Models\Player;
use App\Models\Team;
use App\Services\NbaStatsService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('players:sync-stats {season=2025-26}', function (NbaStatsService $nbaStatsService) {
    $season = (string) $this->argument('season');
    $this->info("Fetching NBA player stats for {$season}...");

    try {
        $remoteRows = $nbaStatsService->fetchPlayerPerGameStats($season);
    } catch (\Throwable $exception) {
        $this->error('Failed to fetch NBA stats: ' . $exception->getMessage());
        return 1;
    }

    $remoteByName = $remoteRows->mapWithKeys(function (array $row) use ($nbaStatsService) {
        $name = (string) ($row['PLAYER_NAME'] ?? '');

        return [$nbaStatsService->normalizeName($name) => $row];
    });

    $updated = 0;

    Player::query()->get()->each(function (Player $player) use (&$updated, $remoteByName, $nbaStatsService) {
        $lookup = $nbaStatsService->normalizeName((string) $player->full_name);
        $stats = $remoteByName->get($lookup);

        if (! $stats) {
            return;
        }

        $player->update([
            'team' => data_get($stats, 'TEAM_ABBREVIATION', $player->team),
            'gp' => data_get($stats, 'GP'),
            'min' => data_get($stats, 'MIN'),
            'ppg' => data_get($stats, 'PTS'),
            'rpg' => data_get($stats, 'REB'),
            'apg' => data_get($stats, 'AST'),
            'spg' => data_get($stats, 'STL'),
            'bpg' => data_get($stats, 'BLK'),
            'tpg' => data_get($stats, 'TOV'),
            'fgm' => data_get($stats, 'FGM'),
            'fga' => data_get($stats, 'FGA'),
            'fg_prc' => is_null(data_get($stats, 'FG_PCT')) ? null : data_get($stats, 'FG_PCT') * 100,
            'three_pm' => data_get($stats, 'FG3M'),
            'three_pa' => data_get($stats, 'FG3A'),
            'three_prc' => is_null(data_get($stats, 'FG3_PCT')) ? null : data_get($stats, 'FG3_PCT') * 100,
            'ftm' => data_get($stats, 'FTM'),
            'fta' => data_get($stats, 'FTA'),
            'ft_prc' => is_null(data_get($stats, 'FT_PCT')) ? null : data_get($stats, 'FT_PCT') * 100,
            'oreb' => data_get($stats, 'OREB'),
            'dreb' => data_get($stats, 'DREB'),
            'pf' => data_get($stats, 'PF'),
            'dd2' => data_get($stats, 'DD2'),
            'td3' => data_get($stats, 'TD3'),
            'plus_minus' => data_get($stats, 'PLUS_MINUS'),
        ]);

        $updated++;
    });

    $this->info("Done. Updated {$updated} players.");

    return 0;
})->purpose('Sync player per-game stats from stats.nba.com');

Schedule::command('players:sync-stats 2025-26')->dailyAt('04:00');

Artisan::command('teams:sync-stats {season=2025-26}', function (NbaStatsService $nbaStatsService) {
    $season = (string) $this->argument('season');
    $this->info("Fetching NBA team stats for {$season}...");

    try {
        $remoteRows = $nbaStatsService->fetchTeamTraditionalStats($season);
    } catch (\Throwable $exception) {
        $this->error('Failed to fetch NBA team stats: ' . $exception->getMessage());
        return 1;
    }

    $remoteByName = $remoteRows->mapWithKeys(function (array $row) use ($nbaStatsService) {
        $name = (string) ($row['TEAM_NAME'] ?? '');

        return [$nbaStatsService->normalizeTeamName($name) => $row];
    });

    $updated = 0;

    Team::query()->get()->each(function (Team $team) use (&$updated, $remoteByName, $nbaStatsService) {
        $lookup = $nbaStatsService->normalizeTeamName((string) $team->name);
        $stats = $remoteByName->get($lookup);

        if (! $stats) {
            return;
        }

        $team->update([
            'gp' => data_get($stats, 'GP'),
            'w' => data_get($stats, 'W'),
            'l' => data_get($stats, 'L'),
            'w_pct' => data_get($stats, 'W_PCT'),
            'min' => data_get($stats, 'MIN'),
            'pts' => data_get($stats, 'PTS'),
            'fgm' => data_get($stats, 'FGM'),
            'fga' => data_get($stats, 'FGA'),
            'fg_pct' => data_get($stats, 'FG_PCT'),
            'fg3m' => data_get($stats, 'FG3M'),
            'fg3a' => data_get($stats, 'FG3A'),
            'fg3_pct' => data_get($stats, 'FG3_PCT'),
            'ftm' => data_get($stats, 'FTM'),
            'fta' => data_get($stats, 'FTA'),
            'ft_pct' => data_get($stats, 'FT_PCT'),
            'oreb' => data_get($stats, 'OREB'),
            'dreb' => data_get($stats, 'DREB'),
            'reb' => data_get($stats, 'REB'),
            'ast' => data_get($stats, 'AST'),
            'tov' => data_get($stats, 'TOV'),
            'stl' => data_get($stats, 'STL'),
            'blk' => data_get($stats, 'BLK'),
            'blka' => data_get($stats, 'BLKA'),
            'pf_team' => data_get($stats, 'PF'),
            'pfd' => data_get($stats, 'PFD'),
            'plus_minus' => data_get($stats, 'PLUS_MINUS'),
        ]);

        $updated++;
    });

    $this->info("Done. Updated {$updated} teams.");

    return 0;
})->purpose('Sync team traditional stats from stats.nba.com');

Schedule::command('teams:sync-stats 2025-26')->dailyAt('04:15');
