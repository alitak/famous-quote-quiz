@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <admin-question
            :game-types='@json($game_types)'
            :entry='@json($question)'
        ></admin-question>
    </div>
@endsection
