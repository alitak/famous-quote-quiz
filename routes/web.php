<?php

use App\Http\Controllers\TopScorersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('top-scorers', TopScorersController::class)->name('top-scorers');

Auth::routes();
