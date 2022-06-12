<?php

namespace App\Http\Requests\Admin;

use App\Rules\SettingValueByType;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'value' => ['required', new SettingValueByType($this->route('setting'))],
        ];
    }
}
