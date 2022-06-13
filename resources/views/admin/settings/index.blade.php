@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Key</th>
                <th scope="col">Value</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($settings as $setting)
                <tr>
                    <td>{{ $setting->name }}</td>
                    <td>{{ $setting->key }}</td>
                    <td>{{ $setting->value }}</td>
                    <td class="d-flex">
                        <a class="btn btn-primary me-2" href="{{ route('admin.settings.edit', $setting) }}">
                            <i class="bi bi-pencil"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
