<?php

namespace Database\Factories;

use App\Models\Result;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResultFactory extends Factory
{
    protected $model = Result::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'total_score' => $this->faker->randomNumber(1),
            'total_unanswered' => $this->faker->randomNumber(1),
            'total_time' => $this->faker->randomNumber(2),
        ];
    }
}
