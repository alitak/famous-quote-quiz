<?php

namespace App\Rules\Settings;

class Boolean implements SettingsRule
{
    public static function passes(string $value, ?string $source = null): bool
    {
        return $value == 0 || $value == 1;
    }
}
