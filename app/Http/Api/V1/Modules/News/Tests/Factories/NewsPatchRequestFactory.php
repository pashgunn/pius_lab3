<?php

namespace App\Http\Api\V1\Modules\News\Tests\Factories;

use Ensi\LaravelTestFactories\BaseApiFactory;

class NewsPatchRequestFactory extends BaseApiFactory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->text(100),
            'author' => $this->faker->name()
        ];
    }

    public function make(array $extra = []): array
    {
        return $this->makeArray($extra);
    }
}
