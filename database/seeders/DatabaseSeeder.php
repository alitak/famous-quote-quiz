<?php

namespace Database\Seeders;

use App\Enums\GameTypeEnum;
use App\Models\Question;
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
        User::query()->updateOrCreate([
            'email' => 'kukel.attila@gmail.com',
        ], [
            'name' => 'Attila Kukel',
            'email_verified_at' => now(),
            'password' => '$2y$10$4F1aFbpiQFjZ/xt7Oj3nPORD4InM1IoLjQZ98Wyk0gOdU.tiBm3wm', // N2ga-wfMF8Cv7Gp
            'is_admin' => 1,
        ]);

        Setting::query()->updateOrCreate([
            'key' => 'game_type',
        ], [
            'name' => 'Game type',
            'value' => GameTypeEnum::MULTIPLE,
            'type' => 'select',
            'source' => GameTypeEnum::class,
        ]);
        Setting::query()->updateOrCreate([
            'key' => 'random_questions',
        ], [
            'name' => 'Random questions',
            'value' => 1,
            'type' => 'boolean',
        ]);
        Setting::query()->updateOrCreate([
            'key' => 'time_for_game',
        ], [
            'name' => 'Time for game in minutes',
            'value' => 5,
            'type' => 'numeric',
        ]);

        Question::factory()->count(50)->create();
    }
}
