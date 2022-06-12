<?php

namespace App\Rules\Settings;

use App\Enums\GameTypeEnum;

class Multiple implements SettingsRule
{
    public static function passes(string $value, ?string $source = null): bool
    {
        return array_search($value, array_column(GameTypeEnum::cases(), 'value')) !== false;
    }
}
