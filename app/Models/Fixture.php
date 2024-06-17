<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    protected $connection = 'mysql';
    protected $table = 'fixture';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fixture_id',
        'fixture_time',
        'season_id',
        'round_id',
        'away_team_id',
        'home_team_id',
    ];

    protected $casts = [
    ];
}
