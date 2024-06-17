<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $connection = 'mysql';
    protected $table = 'round';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'round_lang',
        'round_type_id',
    ];

    protected $casts = [
    ];
}
