<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'comment' => $this->faker->text("200"),
            'user_Id' => $this->faker->numberBetween(1, 10),
            'commentable_id' => rand(1, 500),
            'commentable_type' => 'app\Models\Post'
        ];
    }
}
