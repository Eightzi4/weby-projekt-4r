<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }
}
