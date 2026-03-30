<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;


Route::get('/', [ContactController::class, 'index']);
 Route::post('/contacts/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'thanks'])->name('thanks');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
// ログイン
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// ログアウト
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 登録
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);