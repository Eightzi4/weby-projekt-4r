<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Routy pro veřejné stránky
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/sezony', [PageController::class, 'seasons'])->name('seasons.index');
Route::get('/tymy', [PageController::class, 'teams'])->name('teams.index');

Route::get('/clanek/{link}', [PageController::class, 'show'])->name('articles.show');

