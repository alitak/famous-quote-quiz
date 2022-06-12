<?php

namespace App\Rules\Settings;

class Numeric implements SettingsRule
{
    public static function passes(string $value, ?string $source = null): bool
    {
        return is_numeric($value);
    }
}
