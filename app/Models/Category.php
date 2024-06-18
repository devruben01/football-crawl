<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $connection = 'mysql';
    protected $table = 'category';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'continent_id',
        'category_id',
        'category_name',
        'icon',
    ];

    protected $casts = [
    ];

    public function continent()
    {
        return $this->belongsTo(Continent::class);
    }
    public function tournament()
    {
        return $this->hasMany(Tournament::class);
    }
}
