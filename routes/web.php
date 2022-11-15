<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/home_counters', [HomeController::class, 'homeCounters']);
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('api/search', [HomeController::class, 'searchApi'])->name('searchApi');

Route::get('artists/{artist}', [HomeController::class, 'artist'])->name('artist');
Route::get('artworks/{artwork}', [HomeController::class, 'artwork'])->name('artwork');
