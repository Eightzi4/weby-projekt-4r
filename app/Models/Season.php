<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Season extends Model
{
    use HasFactory;

    protected $table = 'season';

    protected $fillable = [
        'start',
        'finish',
    ];

    /**
     * Získá přiřazení k ligám v této sezóně.
     */
    public function leagueSeasons(): HasMany
    {
        return $this->hasMany(LeagueSeason::class, 'id_season');
    }

    /**
     * Získá všechny ligy v této sezóně přes spojovací tabulku.
     */
    public function leagues(): HasManyThrough
    {
        return $this->hasManyThrough(
            League::class,
            LeagueSeason::class,
            'id_season', // Foreign key on league_season table...
            'id',       // Foreign key on league table...
            'id',       // Local key on season table...
            'id_league' // Local key on league_season table...
        );
    }
}