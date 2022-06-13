<?php

namespace App\Http\Requests\Admin;

class UserRequest extends AdminRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email:rfc'],
            'is_admin' => ['required', 'boolean'],
        ];
    }
}
