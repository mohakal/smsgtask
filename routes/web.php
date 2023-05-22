<?php

use App\Http\Controllers\MovieController;
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

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/searchomdb', function () {
    return view('GetMoviesFromOMDB');
})->middleware(['auth','checkusertype'])->name('searchomdb');




Route::post('/searchomdbpost', [MovieController::class, 'create'])->middleware(['auth','checkusertype'])->name('searchomdbpost');
Route::post('/savemovie', [MovieController::class, 'savemovie'])->middleware(['auth','checkusertype'])->name('savemovie');
Route::get('/allmovies', [MovieController::class, 'allmovies'])->middleware(['auth','checkusertype'])->name('allmovies');
Route::get('/deletemovie/{id}', [MovieController::class, 'destroy'])->middleware(['auth','checkusertype'])->name('deletemovie');
Route::get('/editmovie/{id}', [MovieController::class, 'editmovie'])->middleware(['auth','checkusertype'])->name('editmovie');
Route::post('/updatemovie/{id}', [MovieController::class, 'update'])->middleware(['auth','checkusertype'])->name('updatemovie');
Route::post('/searchmovie', [MovieController::class, 'searchmovie'])->middleware(['auth','checkusertype'])->name('searchmovie');
Route::get('/movies', [MovieController::class, 'subcribermovies'])->middleware(['auth'])->name('movies');
Route::get('/playmovie/{id}', [MovieController::class, 'playmovie'])->middleware(['auth'])->name('playmovie');
Route::get('/rentmovie/{id}', [MovieController::class, 'rentmovie'])->middleware(['auth'])->name('rentmovie');
Route::post('/serachmoviebysubs', [MovieController::class, 'serachmoviebysubs'])->middleware(['auth'])->name('serachmoviebysubs');
require __DIR__.'/auth.php';
