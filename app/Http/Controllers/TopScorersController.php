<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Contracts\View\View;

class TopScorersController extends Controller
{
    public function __invoke(): View
    {
        return view('results.index', ['results' => Result::getForTopScorers()]);
    }
}
