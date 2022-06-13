@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <form action="{{ $user->id ? route('admin.users.update', $user) : route('admin.users.store')}}" method="POST">
            @csrf
            @if ($user->id)
                @method('put')
            @endif
            <div class="mb-3">
                <label for="name" class="form-label">@lang('Name')</label>
                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" value="{{ old('name', $user->name) }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">@lang('Email')</label>
                <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" value="{{ old('email', $user->email) }}">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input class="form-check-input" type="checkbox" value="1" name="is_admin" id="is_admin" {{ old('is_admin', $user->is_admin) == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="is_admin">
                    @lang('Is admin')
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
