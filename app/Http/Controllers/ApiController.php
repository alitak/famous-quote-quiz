<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Setting;

class ApiController extends Controller
{
    public function __invoke()
    {
        return response()->json([
            'timeForGame' => Setting::get('time_for_game') * 60,
            'questions' => Question::getForQuiz(),
            'gameType' => Setting::get('game_type'),
        ]);
    }
}
