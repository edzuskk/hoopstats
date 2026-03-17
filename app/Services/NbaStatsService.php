<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class NbaStatsService
{
    public function fetchPlayerPerGameStats(string $season = '2025-26'): Collection
    {
        $response = Http::retry(3, 1500)
            ->withOptions([
                'connect_timeout' => 15,
                'timeout' => 45,
                'http_errors' => false,
                'curl' => [
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_ENCODING => '',
                ],
            ])->withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
            'Referer' => 'https://www.nba.com/',
            'Origin' => 'https://www.nba.com',
            'Accept' => 'application/json, text/plain, */*',
            'Accept-Language' => 'en-US,en;q=0.9',
            'Connection' => 'keep-alive',
        ])->get('https://stats.nba.com/stats/leaguedashplayerstats', [
            'MeasureType' => 'Base',
            'PerMode' => 'PerGame',
            'PlusMinus' => 'N',
            'PaceAdjust' => 'N',
            'Rank' => 'N',
            'LeagueID' => '00',
            'Season' => $season,
            'SeasonType' => 'Regular Season',
            'PORound' => '0',
            'Outcome' => '',
            'Location' => '',
            'Month' => '0',
            'SeasonSegment' => '',
            'DateFrom' => '',
            'DateTo' => '',
            'OpponentTeamID' => '0',
            'VsConference' => '',
            'VsDivision' => '',
            'GameSegment' => '',
            'Period' => '0',
            'ShotClockRange' => '',
            'LastNGames' => '0',
        ]);

        $response->throw();

        $payload = $response->json();
        $set = data_get($payload, 'resultSets.0', []);
        $headers = collect(data_get($set, 'headers', []));
        $rows = collect(data_get($set, 'rowSet', []));

        return $rows->map(function (array $row) use ($headers) {
            return $headers->combine($row)->toArray();
        });
    }

    public function normalizeName(string $name): string
    {
        $name = Str::ascii($name);
        $name = mb_strtolower(trim($name));
        $name = str_replace(['.', "'", '’'], '', $name);
        $name = preg_replace('/\s+/', ' ', $name);

        return $name;
    }

    public function fetchTeamTraditionalStats(string $season = '2025-26'): Collection
    {
        $response = Http::retry(3, 1500)
            ->withOptions([
                'connect_timeout' => 15,
                'timeout' => 45,
                'http_errors' => false,
                'curl' => [
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_ENCODING => '',
                ],
            ])->withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
                'Referer' => 'https://www.nba.com/',
                'Origin' => 'https://www.nba.com',
                'Accept' => 'application/json, text/plain, */*',
                'Accept-Language' => 'en-US,en;q=0.9',
                'Connection' => 'keep-alive',
            ])->get('https://stats.nba.com/stats/leaguedashteamstats', [
                'MeasureType' => 'Base',
                'PerMode' => 'PerGame',
                'PlusMinus' => 'N',
                'PaceAdjust' => 'N',
                'Rank' => 'N',
                'LeagueID' => '00',
                'Season' => $season,
                'SeasonType' => 'Regular Season',
                'PORound' => '0',
                'Outcome' => '',
                'Location' => '',
                'Month' => '0',
                'SeasonSegment' => '',
                'DateFrom' => '',
                'DateTo' => '',
                'OpponentTeamID' => '0',
                'VsConference' => '',
                'VsDivision' => '',
                'GameSegment' => '',
                'Period' => '0',
                'ShotClockRange' => '',
                'LastNGames' => '0',
            ]);

        $response->throw();

        $payload = $response->json();
        $set = data_get($payload, 'resultSets.0', []);
        $headers = collect(data_get($set, 'headers', []));
        $rows = collect(data_get($set, 'rowSet', []));

        return $rows->map(function (array $row) use ($headers) {
            return $headers->combine($row)->toArray();
        });
    }

    public function normalizeTeamName(string $name): string
    {
        $name = $this->normalizeName($name);

        return match ($name) {
            'la clippers' => 'los angeles clippers',
            default => $name,
        };
    }
}
