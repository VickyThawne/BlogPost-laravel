<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

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
        $title = $this->faker->unique()->word(3);
        $slug = Str::slug($title);
        return [
            'title' => $title,
            'slug' => $slug,
            'user_id' => User::factory(),
            'excerpt' => $this->faker->realTextBetween(50, 60),
            'body' => $this->faker->realTextBetween(500, 1500),
            'category_id' => Category::factory(),
        ];
    }
}
