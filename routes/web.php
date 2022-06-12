<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\QuestionsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => [Authenticate::class],
], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('settings', SettingsController::class)->only(['index', 'edit', 'update']);
    Route::resource('questions', QuestionsController::class)->except(['show']);
});

Route::group([
    'prefix' => 'api',
    'as' => 'api.',
], function () {
    Route::get('init', ApiController::class)->name('init');
});
