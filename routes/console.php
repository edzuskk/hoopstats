<?php

use App\Models\Player;
use App\Models\Team;
use App\Services\NbaStatsService;
use Illuminate\Support\Facades\Artisan;

/** Šī komanda gūst spēlētāju datus no stats.nba.com un atjaunina datubāzi. */
Artisan::command('players:sync-stats {season?}', function (NbaStatsService $nbaStatsService) {
    // Gūst sezonas argumentu, un ja tas nav norādīts, tiek izmantota noklusējuma vērtība "2025-26".
    $season = (string) ($this->argument('season') ?: config('services.nba.default_season', '2025-26'));
    // Izvada informāciju, ka tiek gūta spēlētāju statistika.
    $this->info("Gūst NBA spēlētāju statistiku {$season}...");

    // Mēģina gūt datus no stats.nba.com, un ja tas neizdodas, izvada kļūdas ziņojumu.
    try {
        $remoteRows = $nbaStatsService->fetchPlayerPerGameStats($season);
    } catch (\Throwable $exception) {
        $this->error('Neizdevās iegūt NBA spēlētāju statistiku: ' . $exception->getMessage());
        return 1;
    }

    // Pārveido gūtos datus par kolekciju, kur atslēga ir spēlētāja normalizētais vārds, lai vieglāk salīdzināt ar datubāzes ierakstiem.
    $remoteByName = $remoteRows->mapWithKeys(function (array $row) use ($nbaStatsService) {
        // Šeit tiek gūts spēlētāja vārds no gūtajiem datiem, un ja tas nav pieejams, tiek izmantota tukša vērtība.
        $name = (string) ($row['PLAYER_NAME'] ?? '');
        // Šeit tiek normalizēts spēlētāja vārds, lai tas būtu salīdzināms ar datubāzes ierakstiem, un tiek izveidots asociatīvs masīvs, kur atslēga ir normalizētais vārds un vērtība ir gūtie dati par spēlētāju.
        return [$nbaStatsService->normalizeName($name) => $row];
    });

    // Šis skaitītājs seko, cik spēlētāju ir atjaunoti.
    $updated = 0;

    // Šis cikls iterē cauri visiem spēlētājiem datubāzē, meklē atbilstošos datus no gūtajiem datiem un atjaunina katra spēlētāja statistiku.
    Player::query()->get()->each(function (Player $player) use (&$updated, $remoteByName, $nbaStatsService) {
        // Šeit tiek meklēts gūtajos datos spēlētājs, kura vārds atbilst datubāzes spēlētāja vārdam, un ja dati ir gūti, tiek atjaunota statistika datubāzē.
        $lookup = $nbaStatsService->normalizeName((string) $player->full_name);
        // Gūst statistiku no gūtajiem datiem, izmantojot normalizēto vārdu kā atslēgu.
        $stats = $remoteByName->get($lookup);
        // Ja nav gūti dati par spēlētāju, tad tiek izlaists un netiek atjaunots.
        if (! $stats) {
            return;
        }

        // Atjaunina spēlētāja statistiku datubāzē, izmantojot gūtos datus. Ja kāds no datiem nav pieejams, tiek izmantota esošā vērtība.
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

    // Pēc tam, kad visi spēlētāji ir apstrādāti, izvada ziņojumu par to, cik spēlētāju ir atjaunoti.
    $this->info("Gatavs. Atjaunots {$updated} spēlētāju.");
    // Atgriež 0, lai norādītu, ka komanda ir veiksmīgi izpildīta.
    return 0;
    // Komandas mērķis ir sinhronizēt spēlētāju per-game statistiku no stats.nba.com.
})->purpose('Sync player per-game stats from stats.nba.com');

// Šī komanda gūst un atjauno komandu statistiku.
Artisan::command('teams:sync-stats {season?}', function (NbaStatsService $nbaStatsService) {
    // Gūst sezonas argumentu, un ja tas nav norādīts, tiek izmantota noklusējuma vērtība "2025-26".
    $season = (string) ($this->argument('season') ?: config('services.nba.default_season', '2025-26'));
    // Izvada informāciju, ka tiek gūta komandu statistika.
    $this->info("Gūst NBA komandu statistiku {$season}...");

    // Mēģina gūt datus no stats.nba.com, un ja tas neizdodas, izvada kļūdas ziņojumu.
    try {
        $remoteRows = $nbaStatsService->fetchTeamTraditionalStats($season);
    } catch (\Throwable $exception) {
        $this->error('Neizdevās gūt NBA komandu statistiku: ' . $exception->getMessage());
        return 1;
    }
    // Pārveido gūtos datus par kolekciju, kur atslēga ir komandas normalizētais nosaukums, lai vieglāk salīdzināt ar datubāzes ierakstiem.
    $remoteByName = $remoteRows->mapWithKeys(function (array $row) use ($nbaStatsService) {
        $name = (string) ($row['TEAM_NAME'] ?? '');

        return [$nbaStatsService->normalizeTeamName($name) => $row];
    });
    // Šis skaitītājs seko, cik komandu ir atjaunotas.
    $updated = 0;
    // Šis gūst un atjauno katras komandas statistiku.
    Team::query()->get()->each(function (Team $team) use (&$updated, $remoteByName, $nbaStatsService) {
        // Šeit tiek meklēts gūtajos datos komanda, kuras nosaukums atbilst datubāzes komandas nosaukumam, un ja dati ir gūti, tiek atjaunota statistika datubāzē.
        $lookup = $nbaStatsService->normalizeTeamName((string) $team->name);
        // Gūst statistiku no gūtajiem datiem, izmantojot normalizēto nosaukumu kā atslēgu.
        $stats = $remoteByName->get($lookup);
        // Ja nav gūti dati par komandu, tad tiek izlaists un netiek atjaunots.
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
    // Pēc tam, kad visas komandas ir apstrādātas, izvada ziņojumu par to, cik komandu ir atjaunotas.
    $this->info("Gatavs. Atjaunotas {$updated} komandas.");
    // Atgriež 0, lai norādītu, ka komanda ir veiksmīgi izpildīta.
    return 0;
    // Komandas mērķis ir sinhronizēt komandu tradicionālo statistiku no stats.nba.com.
})->purpose('Sync team traditional stats from stats.nba.com');
