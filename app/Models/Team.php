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
        'team_id',
        'team_name',
        'logo_url',
    ];

    protected $casts = [
    ];
}
