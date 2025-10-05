<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function show(Game $game)
    {
        $game->load(['homeTeam', 'awayTeam']);

        return view('seasons.rounds.games.show', compact('game'));
    }
}
