<?php

use App\Http\Controllers\Admin\DahboardController;
use Illuminate\Support\Facades\Route;


Route::get('dashboard', [DahboardController::class, 'index'])->name('dashboard');
