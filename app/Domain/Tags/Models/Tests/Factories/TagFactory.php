<?php

namespace App\Domain\Tags\Models\Tests\Factories;

use App\Domain\Tags\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tag>
 */
class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

    public function definition(): array
    {
        return [
            'slug' => $this->faker->unique()->slug(1),
            'name' => $this->faker->words(2, true)
        ];
    }
}
