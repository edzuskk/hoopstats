<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Team;

class PlayerController extends Controller
{
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
    public function getPlayers($playerID)
    {
        $player = Player::where('id', $playerID)->firstOrFail();
        return view('dashboard.players', compact('player'));
    }

    public function getTeams($teamID)
    {
        $team = Team::where('team_id', $teamID)->firstOrFail();
        return view('dashboard.teams', compact('team'));
    }

    public function getPlayerInfo($playerID)
    {
        $players = Player::where('id', $playerID)->firstOrFail();
        return view('dashboard.players.show', compact('players'));
    }
}
