<?php

use DF\LaravelInfo\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/laravel-info', [HomeController::class, 'index'])->name('laravel-info.index');
