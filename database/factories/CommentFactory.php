<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function () {
                return User::all()->random()->id;
            },
            'body' => $this->faker->text()
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Comment $comment) {
            $comment->user_id = $comment->twit->user_id;
            $comment->save();
        });
    }
}
