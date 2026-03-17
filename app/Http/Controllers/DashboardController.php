<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Team;

class DashboardController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function topPlayers()
    {
        $topShooter = Player::orderByDesc('ppg')->take(1)->get();
        $topRebounder = Player::orderByDesc('rpg')->take(1)->get();
        $topAssister = Player::orderByDesc('apg')->take(1)->get();
        $topBlocker = Player::orderByDesc('bpg')->take(1)->get();
        $topStealer = Player::orderByDesc('spg')->take(1)->get();
        
        return view('welcome', compact('topShooter', 'topRebounder', 'topAssister', 'topBlocker', 'topStealer'));

    }
}
