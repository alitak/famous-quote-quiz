<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'numeric', Rule::exists('users', 'id')],
            'total_score' => ['required', 'numeric', 'min:0'],
            'total_unanswered' => ['required', 'numeric', 'min:0'],
            'total_time' => ['required', 'numeric', 'min:0'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->id(),
        ]);
    }
}
