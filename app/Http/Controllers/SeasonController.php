<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Season;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function index()
    {
        $seasons = Season::with('leagues')
            ->latest('start')
            ->paginate(25);

        return view('seasons.index', compact('seasons'));
    }

    public function show(Season $season)
    {
        $leagueSeasonIds = $season->leagueSeasons()->pluck('id');

        $games = Game::whereIn('id_league_season', $leagueSeasonIds)
            ->with(['homeTeam', 'awayTeam'])
            ->orderBy('round')
            ->orderBy('date')
            ->get();

        $gamesByRound = $games->groupBy('round');

        return view('seasons.rounds.show', compact('season', 'gamesByRound'));
    }
}
