<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TimeStampController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

Auth::routes(['verify' => true]);

// 勤怠管理計算表示
Route::get('/work', [TimeStampController::class, 'work']);
Route::post('/work', [TimeStampController::class, 'work'])->middleware(['auth', 'verified'])->name('work');

// 全体勤怠管理表示
Route::get('/attendance', [TimeStampController::class, 'attendance'])->middleware(['auth', 'verified'])->name('attendance');

// ユーザー一覧ページ表示
Route::get('/user', [TimeStampController::class, 'user'])->name('user');
Route::post('/user', [TimeStampController::class, 'user'])->middleware(['auth', 'verified'])->name('user');

// 個人勤怠管理ページ表示
Route::get('/individual', [TimeStampController::class, 'individual'])->name('individual');
Route::post('/individual', [TimeStampController::class, 'individual'])->middleware(['auth', 'verified'])->name('individual');

// ホーム画面表示
Route::get('/home', [TimeStampController::class, 'home'])->middleware(['auth', 'verified'])->name('home');
Route::post('/home', [TimeStampController::class, 'home'])->middleware(['auth', 'verified'])->name('home');

// ログアウトボタン
Route::post('/logout', [TimeStampController::class, 'logout'])->name('logout');

// メール認証
Route::get('sample/mail', 'SampleController@mail');

// メール確認通知ビュー
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// メール確認処理
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

// メール再送信処理
Route::post('/email/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');