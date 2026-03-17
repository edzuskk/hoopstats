<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Player extends Model
{
    protected $fillable = [
        'team_id',
        'team',
        'photo_url',
        'full_name',
        'birthday',
        'college',
        'height',
        'weight',
        'position',
        'jersey_number',
        'draft_year',
        'draft_round',
        'draft_number',
        'country',
        'gp',
        'min',
        'ppg',
        'rpg',
        'apg',
        'spg',
        'bpg',
        'tpg',
        'fgm',
        'fga',
        'fg_prc',
        'three_pm',
        'three_pa',
        'three_prc',
        'ftm',
        'fta',
        'ft_prc',
        'oreb',
        'dreb',
        'pf',
        'dd2',
        'td3',
        'plus_minus',
    ];

    protected $casts = [
        'draft_year' => 'integer',
        'draft_round' => 'integer',
        'draft_number' => 'integer',
        'height' => 'integer',
        'weight' => 'integer',
        'jersey_number' => 'integer',
        'gp'=> 'integer',
        'min' => 'float',
        'ppg' => 'float',
        'rpg' => 'float',
        'apg' => 'float',
        'spg' => 'float',
        'bpg' => 'float',
        'tpg' => 'float',
        'fgm' => 'float',
        'fga' => 'float',
        'fg_prc' => 'float',
        'three_pm' => 'float',
        'three_pa' => 'float',
        'three_prc' => 'float',
        'ftm' => 'float',
        'fta' => 'float',
        'ft_prc' => 'float',
        'oreb' => 'float',
        'dreb' => 'float',
        'pf' => 'float',
        'dd2' => 'integer',
        'td3' => 'integer',
        'plus_minus' => 'float',
    ];

    public function teamModel(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
