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
    public function show($link)
    {
        // Najdeme článek v databázi podle sloupce 'link'.
        // firstOrFail() automaticky vrátí chybu 404, pokud článek nenajde.
        $article = Article::where('link', $link)->firstOrFail();

        // Předáme nalezený článek do nového pohledu
        return view('pages.articles.show', compact('article'));
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