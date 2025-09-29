<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article; // Přidáme později pro načtení článků
use App\Models\Season;
use App\Models\Game;

class PageController extends Controller
{
    /**
     * Zobrazí úvodní stránku s dlaždicemi článků.
     */
    public function home()
    {
        // Odkomentovali jsme následující dva řádky
        $articles = Article::published()->top()->latest('date')->get();
        return view('pages.home', ['articles' => $articles]);

        // Tento řádek smažeme, protože už je nadbytečný
        // return view('pages.home');
    }

    /**
     * Zobrazí detail konkrétního článku.
     *
     * @param  string  $link
     * @return \Illuminate\View\View
     */
    public function show(Article $article)
    {
        return view('pages.articles.show', compact('article'));
    }

    /**
     * Zobrazí stránku se sezónami.
     */
    public function seasons()
    {
        // Načteme sezóny, seřadíme od nejnovější (podle sloupce 'start').
        // Použijeme eager loading pro načtení všech souvisejících lig najednou.
        // Aplikujeme stránkování po 25 záznamech.
        $seasons = Season::with('leagues')
                         ->latest('start')
                         ->paginate(25);

        return view('pages.seasons', compact('seasons'));
    }

    public function seasonMatches(Season $season)
    {
        // Načteme všechny zápasy, které patří do těchto LeagueSeason záznamů
        // a seřadíme je podle kola a data
        $games = Game::whereIn('id_league_season', $season)
                     ->with(['homeTeam', 'awayTeam']) // Načteme rovnou i názvy týmů
                     ->orderBy('round')
                     ->orderBy('date')
                     ->get();

        // Seskupíme zápasy podle čísla kola
        $gamesByRound = $games->groupBy('round');

        return view('pages.seasons.show', compact('season', 'gamesByRound'));
    }

    public function gameDetails(Game $game)
    {
        // Laravel díky Route Model Binding automaticky načte zápas i s týmy,
        // ale pro jistotu je můžeme načíst znovu explicitně.
        $game->load(['homeTeam', 'awayTeam']);

        return view('pages.games.show', compact('game'));
    }

    /**
     * Zobrazí prázdnou stránku pro týmy.
     */
    public function teams()
    {
        return view('pages.teams');
    }
}