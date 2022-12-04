<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeagueController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// https://laravel.com/docs/9.x/controllers
// index (get), create (get), store (post), show (get), edit (get), update (put), destroy (delete)
Route::get('/', function () {
    if (auth()->check()) { //a user is logged in
        return redirect()->route('home.index');
    }
    return view('welcome');
})->name('welcome');

Route::get('/template', function () {
    return view('template');
});

Route::get('connexion', [AuthController::class, 'index'])->name('auth.login.index');
Route::post('connexion', [AuthController::class, 'login'])->name('auth.login');
Route::get('inscription', [AuthController::class, 'create'])->name('auth.register.index');
Route::post('inscription', [AuthController::class, 'store'])->name('auth.register');
Route::get('deconnexion', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('accueil', function() {
    return view('home');
})->name('home.index')->middleware('auth');

Route::get('ligues', [LeagueController::class, 'browse'])->name('league.browse')->middleware('auth');
Route::post('ligues/favori', [LeagueController::class, 'favorite'])->name('league.favorite')->middleware('auth');
Route::get('ligues/rejoindre/{code}', [LeagueController::class, 'join'])->name('league.join')->middleware('auth');