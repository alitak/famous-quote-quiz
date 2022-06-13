<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResultRequest;
use App\Models\Result;
use Illuminate\Http\Response;

class ResultsController extends Controller
{
    public function __invoke(ResultRequest $request): Response
    {
        Result::query()->create($request->validated());

        return response(null, 204);
    }
}
