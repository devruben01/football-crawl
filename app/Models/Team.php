<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $connection = 'mysql';
    protected $table = 'team';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'away_team_id',
        'away_team_name',
        'away_logo_url',
    ];

    protected $casts = [
    ];
}
