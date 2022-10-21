<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TvController;
use Illuminate\Support\Facades\Route;

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


Route::get('/auth', [AuthController::class, 'auth_form'])->name('auth_form');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

Route::get('/', [MovieController::class, 'index']);
Route::get('/movie', [MovieController::class, 'index'])->name('movie.index');
Route::get('/movie/{movie}', [MovieController::class, 'show'])->name('movie.show');

Route::get('/actor', [ActorController::class, 'index'])->name('actor.index');
Route::get('/actor/{actor}', [ActorController::class, 'show'])->name('actor.show');
Route::get('/actor/page/{page}', [ActorController::class, 'index']);

Route::get('/tv', [TvController::class, 'index'])->name('tv.index');
Route::get('/tv/{tv}', [TvController::class, 'show'])->name('tv.show');


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/movie_list/save', [DashboardController::class, 'save'])->name('movie_list.save');
    Route::post('/dashboard/movie_list/delete', [DashboardController::class, 'delete'])->name('movie_list.delete');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
