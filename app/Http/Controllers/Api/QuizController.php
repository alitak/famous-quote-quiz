<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;

class QuizController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'timeForGame' => Setting::get('time_for_game') * 60,
            'questions' => Question::getForQuiz(),
            'gameType' => Setting::get('game_type'),
        ]);
    }
}
