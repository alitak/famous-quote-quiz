<?php

namespace Database\Factories;

use App\Enums\GameTypeEnum;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition(): array
    {
        $game_type = $this->faker->randomElement(GameTypeEnum::cases())->value;

        return [
            'type' => $game_type,
            'question' => $this->faker->sentence(),
            'answer_1' => GameTypeEnum::BINARY->value == $game_type ? null : $this->faker->sentence(),
            'answer_2' => GameTypeEnum::BINARY->value == $game_type ? null : $this->faker->sentence(),
            'answer_3' => GameTypeEnum::BINARY->value == $game_type ? null : $this->faker->sentence(),
            'correct_answer' => GameTypeEnum::BINARY->value == $game_type ? $this->faker->numberBetween(1, 2) : $this->faker->numberBetween(1, 3),
        ];
    }
}
