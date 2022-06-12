<?php

namespace App\Http\Requests\Admin;

use App\Enums\GameTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class QuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'question' => ['required', 'string', 'max:255'],
            'type' => ['required', new Enum(GameTypeEnum::class)],
            'answer_1' => ['nullable', Rule::requiredIf($this->type == GameTypeEnum::MULTIPLE->value), 'string', 'max:255'],
            'answer_2' => ['nullable', Rule::requiredIf($this->type == GameTypeEnum::MULTIPLE->value), 'string', 'max:255'],
            'answer_3' => ['nullable', Rule::requiredIf($this->type == GameTypeEnum::MULTIPLE->value), 'string', 'max:255'],
            'correct_answer' => ['required', function ($attribute, $value, $fail) {
                // this is awful, I know, better would be with match/own classes, like settings rule by type
                if ($this->type == GameTypeEnum::MULTIPLE->value) {
                    if (!in_array($value, [2, 3])) return $fail('Correct answer should be 1, 2 or 3');
                } else {
                    if (!in_array($value, [0, 1])) return $fail('Correct answer should be true or false');
                }
            }],
        ];
    }
}
