<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductinController;
use App\Http\Controllers\ProductoutController;
use App\Http\Controllers\ReportController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', [AuthController::class, 'showRegisterForm'])->name('signup.form');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::get('/dashboard', [Dashboard::class, 'dashboard'])->name('dashboard');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::resource('products',  ProductController::class);
Route::resource('productin', ProductinController::class);
Route::resource('productout', ProductoutController::class);
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');


