<?php

namespace App\Rules;

use App\Exceptions\SettingTypeNotDefined;
use App\Models\Setting;
use App\Rules\Settings\Boolean;
use App\Rules\Settings\Multiple;
use App\Rules\Settings\Numeric;
use Illuminate\Contracts\Validation\Rule;

class SettingValueByType implements Rule
{
    public function __construct(public Setting $setting)
    {
    }

    public function passes($attribute, $value)
    {
        $type = match ($this->setting->type) {
            'select' => Multiple::class,
            'boolean' => Boolean::class,
            'numeric' => Numeric::class,
            default => throw new SettingTypeNotDefined(),
        };

        return $type::passes($value, $this->setting->source);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
