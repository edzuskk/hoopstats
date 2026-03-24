<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Team;

class PlayerController extends Controller
{
    // Parādīt spēlētāju sarakstu ar meklēšanas funkcionalitāti
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $players = Player::with('teamModel')
            ->when($search !== '', function ($query) use ($search) {
                $query->where('full_name', 'like', "%{$search}%");
            })
            ->orderByDesc('ppg')
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.players', compact('players'));
    }

    // Parādīt konkrēta spēlētāja informāciju
    public function getPlayers($playerID)
    {
        $player = Player::where('id', $playerID)->firstOrFail();
        return view('dashboard.players', compact('player'));
    }

    // Parādīt kurā komanda spēlētājs spēlē
    public function getTeams($teamID)
    {
        $team = Team::where('team_id', $teamID)->firstOrFail();
        return view('dashboard.teams', compact('team'));
    }

    // Parādīt konkrēta spēlētāja informāciju
    public function getPlayerInfo($playerID)
    {
        $players = Player::where('id', $playerID)->firstOrFail();
        return view('dashboard.players.show', compact('players'));
    }
}
