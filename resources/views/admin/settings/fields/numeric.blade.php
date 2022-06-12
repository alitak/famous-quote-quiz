<input type="number" class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" id="value" name="value" value="{{ old('value', $setting->value) }}">
