<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamCompareController extends Controller
{
    public function compareIndex()
    {
        $teams = Team::all();
        return view('dashboard.teams.compare', compact('teams'));
    }

    public function compare(Request $request)
    {
        $team1ID = $request->input('team1');
        $team2ID = $request->input('team2');

        $team1 = Team::findOrFail($team1ID);
        $team2 = Team::findOrFail($team2ID);
        $teams = Team::all();

        return view('dashboard.teams.compare', compact('team1', 'team2', 'teams'));
    }
}
