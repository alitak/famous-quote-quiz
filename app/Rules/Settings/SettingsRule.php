<?php

namespace App\Rules\Settings;

interface SettingsRule
{
    public static function passes(string $value, ?string $source = null): bool;
}
