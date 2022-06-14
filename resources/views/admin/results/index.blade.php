@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Total score</th>
                <th>Total unanswered</th>
                <th>Total time</th>
                <th>Submit time</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($results as $result)
                <tr>
                    <td>{{ $result->user->name }}</td>
                    <td>{{ $result->user->email }}</td>
                    <td>{{ $result->total_score }}</td>
                    <td>{{ $result->total_unanswered }}</td>
                    <td>{{ $result->total_time }}</td>
                    <td>{{ $result->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
