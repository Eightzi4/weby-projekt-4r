<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::published()->top()->orderBy('date', 'desc')->get();
        return view('articles.index', ['articles' => $articles]);
    }
}
