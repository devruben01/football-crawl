<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTournament extends Model
{
    protected $connection = 'mysql';
    protected $table = 'category_tournament';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'tournament_id',
    ];

    protected $casts = [
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }
}
