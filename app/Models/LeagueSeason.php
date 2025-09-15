<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LeagueSeason extends Model
{
    use HasFactory;

    protected $table = 'league_season';

    protected $fillable = [
        'id_league',
        'id_season',
    ];

    /**
     * Získá ligu, ke které toto přiřazení patří.
     */
    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class, 'id_league');
    }

    /**
     * Získá sezónu, ke které toto přiřazení patří.
     */
    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class, 'id_season');
    }

    /**
     * Získá všechny zápasy v této lize a sezóně.
     */
    public function games(): HasMany
    {
        return $this->hasMany(Game::class, 'id_league_season');
    }
}