<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class League extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'league';

    protected $fillable = [
        'name',
        'logo',
        'level',
    ];

    /**
     * Získá všechny sezóny, ve kterých se tato liga hrála.
     */
    public function leagueSeasons(): HasMany
    {
        return $this->hasMany(LeagueSeason::class, 'id_league');
    }
}