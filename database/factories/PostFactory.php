<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $title = $this->faker->name;
        $slug = Str::slug($title);
        return [
            'title' => $title,
            'slug' => $slug,
            'excerpt' => $this->faker->text(20),
            'body' => $this->faker->paragraph,
            'category_id' => $this->faker->rand(1, 5),
        ];
    }
}