@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('admin.settings.update', $setting) }}" method="POST">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="name" class="form-label">@lang('Setting Name')</label>
                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" value="{{ old('name', $setting->name) }}">
                @error('name')
                <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="key" class="form-label disabled">@lang('Setting Key')</label>
                <input type="text" class="form-control" id="key" disabled value="{{ $setting->name }}">
            </div>
            <div class="mb-3">
                <label for="value" class="form-label">@lang('Setting Value')</label>
                @include('admin.settings.fields.' . $setting->type)
                @error('value')
                <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
