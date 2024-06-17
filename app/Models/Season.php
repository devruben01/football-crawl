<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $connection = 'mysql';
    protected $table = 'season';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'season_id',
        'tournament_id',
        'season_start',
        'season_end',
        'season_year',
    ];

    protected $casts = [
    ];
}
