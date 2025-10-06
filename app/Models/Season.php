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

    public function leagueSeasons(): HasMany
    {
        return $this->hasMany(LeagueSeason::class, 'id_season');
    }

    public function leagues(): HasManyThrough
    {
        return $this->hasManyThrough(
            League::class,
            LeagueSeason::class,
            'id_season',
            'id',
            'id',
            'id_league'
        );
    }
}