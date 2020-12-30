<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers as App;

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
    return redirect('login');
})->name('home');

Route::resource('home',App\UserController::class)->middleware('auth');
Route::get('home/{id}/edit/',[App\UserController::class, 'edit'])->middleware('auth');

Route::get('profile',[App\UserController::class, 'profile'])->name('profile')->middleware('auth');
Route::post('profile',[App\UserController::class, 'saveProfile'])->middleware('auth');
