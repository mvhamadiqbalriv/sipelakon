<?php

namespace Database\Factories;

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
        return [
            'judul' => $this->faker->words(3, true),
            'slug' => Str::slug($this->faker->words(3, true)),
            'konten' => $this->faker->sentence(),
            'category_post_id' => '1',
            'creator_id' => '1',
        ];
    }
}
