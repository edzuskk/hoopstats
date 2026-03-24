<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerCompareController;
use App\Http\Controllers\TeamCompareController;

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::get('/players', [PlayerController::class, 'index'])->name('players.index');
Route::get('/dashboard/players/{playerID}', [PlayerController::class, 'getPlayerInfo'])->name('players.show');
Route::get('/players/compare', action: [PlayerCompareController::class, 'compareIndex'])->name('players.compare.index');
Route::post('/players/compare', action: [PlayerCompareController::class, 'compare'])->name('players.compare');

Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
Route::get('/dashboard/teams/{teamID}', [TeamController::class, 'getTeamInfo'])->name('teams.show');
Route::get('/teams/compare', action: [TeamCompareController::class, 'compareIndex'])->name('teams.compare.index');
Route::post('/teams/compare', action: [TeamCompareController::class, 'compare'])->name('teams.compare');
