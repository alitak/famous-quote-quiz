<div class="form-check {{ $errors->has('value') ? 'is-invalid' : '' }}">
    <input class="form-check-input" type="radio" name="value" id="radioYes" value="1" {{ old('value', $setting->value) == 1 ? 'checked' : '' }}>
    <label class="form-check-label" for="radioYes">
        @lang('Yes')
    </label>
</div>
<div class="form-check {{ $errors->has('value') ? 'is-invalid' : '' }}">
    <input class="form-check-input" type="radio" name="value" id="radioNo" value="0" {{ old('value', $setting->value) == 0 ? 'checked' : '' }}>
    <label class="form-check-label" for="radioNo">
        @lang('No')
    </label>
</div>
