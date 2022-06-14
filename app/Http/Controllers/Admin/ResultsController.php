<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Result;
use Illuminate\Contracts\View\View;

class ResultsController extends Controller
{
    public function index(): View
    {
        return view('admin.results.index', ['results' => Result::getForTopScorers()]);
    }
}
