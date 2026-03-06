<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'slug' => fake() ->slug(),
            'content' => fake()->paragraph(10, true),
            'status' => fake() ->boolean(80),
            'featured_image' => fake()->imageUrl(800, 600, 'articles', true),
            'category_id' => Category::factory(),

        ];
    }

     public function configure()
     {
        return $this->afterCreating(function ($article) {
            $article->tags()->attach(
                Tag::inRandomOrder()
                    ->limit(rand(1,3))
                    ->pluck('id')
            );
        });
     }
}
