<?php

namespace App\Domain\News\Models\Tests\Factories;

use App\Domain\News\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;
use function Pest\Faker\fake;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    public function published(): NewsFactory
    {
        return $this->state(function () {
            return [
                'published_at' => fake()->dateTimeThisMonth()
            ];
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->text(),
            'body' => fake()->paragraphs(1, asText: true),
            'author' => fake()->name(),
            'published_at' => fake()->boolean() ? fake()->date('Y-m-d H:i:s') : null,
        ];
    }
}

