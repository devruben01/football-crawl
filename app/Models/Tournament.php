<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $connection = 'mysql';
    protected $table = 'tournament';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tournament_id',
        'tournament_name',
        'tournament_en_name',
        'tournament_url_name',
        'logo_url'
    ];

    protected $casts = [
    ];
}
