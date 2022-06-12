@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-primary" href="{{ route('admin.questions.create') }}">
            <i class="bi bi-plus"></i> Add new
        </a>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Question</th>
                <th>Answer 1</th>
                <th>Answer 2</th>
                <th>Answer 3</th>
                <th>Correct answer</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($questions as $question)
                <tr>
                    <td>{{ $question->id }}</td>
                    <td>{{ $question->type }}</td>
                    <td>{{ $question->question }}</td>
                    <td>{{ $question->answer_1 }}</td>
                    <td>{{ $question->answer_2 }}</td>
                    <td>{{ $question->answer_3 }}</td>
                    <td>{{ $question->correct_answer_admin }}</td>
                    <td class="d-flex">
                        <a class="btn btn-primary me-2" href="{{ route('admin.questions.edit', $question) }}">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.questions.destroy', $question) }}" method="POST" onsubmit="return confirm('This will delete question, are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
