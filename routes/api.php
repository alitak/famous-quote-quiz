<?php

use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\ResultsController;
use Illuminate\Support\Facades\Route;

Route::get('quiz', QuizController::class)->name('quiz');
Route::post('results', ResultsController::class)->name('results');
