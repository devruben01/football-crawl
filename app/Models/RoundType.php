<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoundType extends Model
{
    protected $connection = 'mysql';
    protected $table = 'round_type';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'round_type_lang',
        'season_id',
    ];

    protected $casts = [
    ];
}
