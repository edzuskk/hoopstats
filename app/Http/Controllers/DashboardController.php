<?php

namespace App\Http\Controllers;

use App\Models\Player;

class DashboardController extends Controller
{   
    // Parādīt sākuma lapu un labākos spēlētājus dažādās kategorijās
    public function index()
    {
        $topShooter = Player::orderByDesc('ppg')->take(1)->get();
        $topRebounder = Player::orderByDesc('rpg')->take(1)->get();
        $topAssister = Player::orderByDesc('apg')->take(1)->get();
        $topBlocker = Player::orderByDesc('bpg')->take(1)->get();
        $topStealer = Player::orderByDesc('spg')->take(1)->get();
        
        return view('welcome', compact('topShooter', 'topRebounder', 'topAssister', 'topBlocker', 'topStealer'));

    }
}
