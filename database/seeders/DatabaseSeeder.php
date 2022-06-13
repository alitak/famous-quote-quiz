<?php

namespace Database\Seeders;

use App\Enums\GameTypeEnum;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create([
            'name' => 'Attila Kukel',
            'email' => 'kukel.attila@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$4F1aFbpiQFjZ/xt7Oj3nPORD4InM1IoLjQZ98Wyk0gOdU.tiBm3wm', // N2ga-wfMF8Cv7Gp
            'is_admin' => 1,
        ]);

        Setting::query()->create([
            'name' => 'Game type',
            'key' => 'game_type',
            'value' => GameTypeEnum::MULTIPLE,
            'type' => 'select',
            'source' => GameTypeEnum::class,
        ]);
        Setting::query()->create([
            'name' => 'Random questions',
            'key' => 'random_questions',
            'value' => 1,
            'type' => 'boolean',
        ]);
        Setting::query()->create([
            'name' => 'Time for game in minutes',
            'key' => 'time_for_game',
            'value' => 5,
            'type' => 'numeric',
        ]);
    }
}
