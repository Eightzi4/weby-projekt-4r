<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'game';

    protected $fillable = [
        'id_league_season',
        'home',
        'rank_before_home',
        'rank_before_away',
        'away',
        'home_tm',
        'away_tm',
        'date',
        'time',
        'round',
        'stadium',
        'attendance',
        'goals_home',
        'goals_away',
        'ht_goals_home',
        'ht_goals_away',
        'link',
        'finished',
    ];

    protected $casts = [
        'date' => 'date',
        'finished' => 'boolean',
    ];

    /**
     * Získá sezónu a ligu, do které zápas patří.
     */
    public function leagueSeason(): BelongsTo
    {
        return $this->belongsTo(LeagueSeason::class, 'id_league_season');
    }

    /**
     * Získá domácí tým.
     */
    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home');
    }

    /**
     * Získá hostující tým.
     */
    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away');
    }

    /**
     * Vytvoří "virtuální" vlastnost, která ověří, zda je datum zápasu platné.
     * Můžeme ji volat v Blade jako $game->has_valid_date
     *
     * @return bool
     */
    public function getHasValidDateAttribute(): bool
    {
        // Pokud datum není NULL a jeho rok je větší než 0, považujeme ho za platné.
        // Tím odfiltrujeme případy, kdy se "0000-00-00" převede na rok -1 nebo 0.
        return $this->date && $this->date->year > 0;
    }
}
