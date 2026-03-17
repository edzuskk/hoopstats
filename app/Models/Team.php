<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    protected $fillable = [
        'team_id',
        'name',
        'logo_url',
        'division',
        'conference',
        'city',
        'arena',
        'head_coach',
        'lead_assistant_coach',
        'assistant_coach',
        'trainer',
        'trainer_assistant',
        'coach_development',
        'owner',
        'general_manager',
        'founded',
        'championships',
        'gp',
        'w',
        'l',
        'w_pct',
        'min',
        'pts',
        'fgm',
        'fga',
        'fg_pct',
        'fg3m',
        'fg3a',
        'fg3_pct',
        'ftm',
        'fta',
        'ft_pct',
        'oreb',
        'dreb',
        'reb',
        'ast',
        'tov',
        'stl',
        'blk',
        'blka',
        'pf_team',
        'pfd',
        'plus_minus',
    ];

    protected $casts = [
        'team_id' => 'integer',
        'founded' => 'integer',
        'championships' => 'integer',
        'gp' => 'integer',
        'w' => 'integer',
        'l' => 'integer',
        'w_pct' => 'float',
        'min' => 'float',
        'pts' => 'float',
        'fgm' => 'float',
        'fga' => 'float',
        'fg_pct' => 'float',
        'fg3m' => 'float',
        'fg3a' => 'float',
        'fg3_pct' => 'float',
        'ftm' => 'float',
        'fta' => 'float',
        'ft_pct' => 'float',
        'oreb' => 'float',
        'dreb' => 'float',
        'reb' => 'float',
        'ast' => 'float',
        'tov' => 'float',
        'stl' => 'float',
        'blk' => 'float',
        'blka' => 'float',
        'pf_team' => 'float',
        'pfd' => 'float',
        'plus_minus' => 'float',
    ];

    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }
}
