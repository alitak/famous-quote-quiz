<?php

namespace App\Http\Requests\Admin;

use App\Rules\SettingValueByType;

class SettingRequest extends AdminRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'value' => ['required', new SettingValueByType($this->route('setting'))],
        ];
    }
}
