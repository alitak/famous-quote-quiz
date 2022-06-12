<?php

namespace App\Http\Controllers\Admin;

use App\Enums\GameTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\QuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function index()
    {
        return view('admin.questions.index', ['questions' => Question::all()]);
    }

    public function create()
    {
        return view('admin.questions.edit', ['question' => new Question(), 'game_types' => GameTypeEnum::cases()]);
    }

    public function store(QuestionRequest $request)
    {
        Question::query()->create($request->validated());

        flash('Successfully stored!');

        return response()->json(['route' => route('admin.questions.index')]);
    }

    public function edit(Question $question)
    {
        return view('admin.questions.edit', ['question' => $question, 'game_types' => GameTypeEnum::cases()]);
    }

    public function update(QuestionRequest $request, Question $question)
    {
        $question->update($request->validated());

        flash('Successfully updated!');

        return response()->json(['route' => route('admin.questions.index')]);
    }

    public function destroy($id)
    {
        Question::query()->where('id', $id)->delete();

        flash('Successfully deleted!');

        return redirect(route('admin.questions.index'));
    }

}
