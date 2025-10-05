<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\Admin\NavbarItemController;

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/clanky/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/sezony', [SeasonController::class, 'index'])->name('seasons.index');
Route::get('/sezony/{season}', [SeasonController::class, 'show'])->name('seasons.show');

Route::get('/zapas/{game}', [GameController::class, 'show'])->name('games.show');

Route::get('/tymy', [TeamController::class, 'index'])->name('teams.index');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('articles', AdminArticleController::class);
    Route::resource('navbar-items', NavbarItemController::class);
});

Auth::routes();
