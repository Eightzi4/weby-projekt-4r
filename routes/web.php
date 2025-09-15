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

// Auth routy (login, register, logout, etc.)
Auth::routes();

// Příklad routy pro administraci (přidáme později)
// Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
//     Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
// });
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
