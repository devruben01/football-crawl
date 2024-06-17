<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{
    protected $connection = 'mysql';
    protected $table = 'continent';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'continent',
        'continent_icon',
    ];

    protected $casts = [
    ];
}
