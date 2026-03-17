<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class PlayerCompareController extends Controller
{
    public function compareIndex()
    {
        $players = Player::all();
        return view('dashboard.players.compare', compact('players'));
    }

    public function compare(Request $request)
    {
        $player1ID = $request->input('player1');
        $player2ID = $request->input('player2');

        $player1 = Player::findOrFail($player1ID);
        $player2 = Player::findOrFail($player2ID);
        $players = Player::all();

        return view('dashboard.players.compare', compact('player1', 'player2', 'players'));
    }
}
