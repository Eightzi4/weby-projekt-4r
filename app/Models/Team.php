<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'team';

    protected $fillable = [
        'name',
        'logo',
        'mt_id',
    ];

    /**
     * Získá zápasy, kde byl tým domácí.
     */
    public function homeGames(): HasMany
    {
        return $this->hasMany(Game::class, 'home_tm');
    }

    /**
     * Získá zápasy, kde byl tým hostující.
     */
    public function awayGames(): HasMany
    {
        return $this->hasMany(Game::class, 'away_tm');
    }
}