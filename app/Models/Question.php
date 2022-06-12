<?php

namespace App\Models;

use App\Enums\GameTypeEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;

    public const FIELDS_FOR_BINARY = ['id', 'question', 'correct_answer'];
    public const FIELDS_FOR_MULTIPLE = ['id', 'question', 'answer_1', 'answer_2', 'answer_3', 'correct_answer'];

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $table = 'questions';
    protected $guarded = ['id'];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function getForQuiz(): Collection
    {
        $game_type = Setting::get('game_type');

        return self::query()
            ->select(constant('self::FIELDS_FOR_' . Str::upper($game_type)))
            ->when(Setting::get('random_questions'), fn(Builder $query) => $query->inRandomOrder())
            ->where('type', $game_type)
            ->take(3)
            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS & MUTATORS
    |--------------------------------------------------------------------------
    */
    public function correctAnswerAdmin(): Attribute
    {
        return Attribute::make(fn($value) => $this->type == GameTypeEnum::MULTIPLE->value ? ($this->correct_answer . '. answer') : ($this->correct_answer ? 'Yes' : 'No'));
    }
}
