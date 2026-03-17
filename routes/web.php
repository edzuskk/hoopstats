<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerCompareController;
use App\Http\Controllers\TeamCompareController;

Route::get('update', function () {
    Artisan::call('players:sync-stats 2025-26');
    Artisan::call('teams:sync-stats 2025-26');

    return redirect('/');
});


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/', [DashboardController::class, 'topPlayers']);

Route::get('/players', [PlayerController::class, 'index'])->name('dashboard');
Route::get('/dashboard/players', [PlayerController::class, TeamController::class, 'getPlayers', 'getTeams'])->name('dashboard.players');
Route::get('/dashboard/players/{playerID}', [PlayerController::class, 'getPlayerInfo'])->name('players.show');
Route::get('/players/compare', action: [PlayerCompareController::class, 'compareIndex'])->name('dashboard');
Route::post('/players/compare', action: [PlayerCompareController::class, 'compare'])->name('players.compare');

Route::get('/teams', [TeamController::class, 'index'])->name('dashboard');
Route::get('/dashboard/teams', [TeamController::class, 'getTeams'])->name('dashboard.teams');
Route::get('/dashboard/teams/{teamID}', [TeamController::class, 'getTeamInfo'])->name('teams.show');
Route::get('/teams/compare', action: [TeamCompareController::class, 'compareIndex'])->name('dashboard');
Route::post('/teams/compare', action: [TeamCompareController::class, 'compare'])->name('teams.compare');



