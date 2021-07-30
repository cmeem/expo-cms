<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => 'publish',
            'admin_id' => 1,
            'admin_username' => $this->faker->unique()->name(),
            'likes_count' => random_int(100,10000),
            'comments_count' => random_int(100,10000),
            'views_count' => random_int(100,10000),
            'title' => $this->faker->unique()->name(),
            'category' => $this->faker->unique()->name(),
            'content' => Str::random(3000),
            'attachments' => null,
        ];
    }
}
