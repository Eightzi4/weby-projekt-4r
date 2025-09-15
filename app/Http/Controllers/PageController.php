<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article; // Přidáme později pro načtení článků

class PageController extends Controller
{
    /**
     * Zobrazí úvodní stránku s dlaždicemi článků.
     */
    public function home()
    {
        // Zde později přidáme logiku pro načtení článků z databáze
        // $articles = Article::published()->top()->latest('date')->get();
        // return view('pages.home', ['articles' => $articles]);

        return view('pages.home');
    }

    /**
     * Zobrazí stránku se sezónami.
     */
    public function seasons()
    {
        return view('pages.seasons');
    }

    /**
     * Zobrazí prázdnou stránku pro týmy.
     */
    public function teams()
    {
        return view('pages.teams');
    }
}