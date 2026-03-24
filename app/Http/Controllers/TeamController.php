<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Team;

class TeamController extends Controller
{
    // Parādīt komandas
    public function index()
    {
        $teams = Team::orderByDesc('w')->paginate(30);
                
        return view('dashboard.teams', compact('teams'));
    }

    // Parādīt konkrētuu komandu
    public function getTeams($teamID)
    {
        $team = Team::where('team_id', $teamID)->firstOrFail();
        return view('dashboard.teams', compact('team'));
    }

    // Parādīt konkrētas komandas informāciju
    public function getTeamInfo($teamID)
    {
        $teams = Team::where('id', $teamID)->firstOrFail();
        return view('dashboard.teams.show', compact('teams'));
    }
}
