<?php

namespace Database\Factories;

use App\Models\Twit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\twit>
 */
class twitFactory extends Factory
{
    protected $model = Twit::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'body' => $this->faker->text,
        ];
    }
}
