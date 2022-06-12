<select class="form-select {{ $errors->has('value') ? 'is-invalid' : '' }}" aria-label="Default select example" name="value">
    @foreach ($setting->source::cases() as $option)
        <option {{ $option->value == $setting->value ? 'selected' : '' }} value="{{ $option->value }}">{{ $option->name }}</option>
    @endforeach
</select>
