<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class AdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('access-admin');
    }
}
