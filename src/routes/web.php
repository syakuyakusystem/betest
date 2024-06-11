<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TimeStampController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/work', [TimeStampController::class, 'work']);
Route::post('/work', [TimeStampController::class, 'work'])->name('work');

Route::get('/attendance', [TimeStampController::class, 'attendance'])->name('attendance');

Route::get('/home', [TimeStampController::class, 'home']);
Route::post('/home', [TimeStampController::class, 'home'])->name('home');

Route::get('/logout', [TimeStampController::class, 'login']);

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);