<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
