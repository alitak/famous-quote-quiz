<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\QuestionsController;
use App\Http\Controllers\Admin\ResultsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('settings', SettingsController::class)->only(['index', 'edit', 'update']);
Route::resource('questions', QuestionsController::class)->except(['show']);
Route::resource('users', UsersController::class)->only(['index', 'edit', 'update', 'destroy']);

Route::get('results', [ResultsController::class, 'index'])->name('results.index');
