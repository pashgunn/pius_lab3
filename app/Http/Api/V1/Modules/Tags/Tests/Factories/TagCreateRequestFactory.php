<?php

namespace App\Http\Api\V1\Modules\Tags\Tests\Factories;


use Ensi\LaravelTestFactories\BaseApiFactory;

class TagCreateRequestFactory extends BaseApiFactory
{

    protected function definition(): array
    {
        return [
            'slug' => $this->faker->unique()->slug(1),
            'name' => $this->faker->words(2, true)
        ];
    }

    public function make(array $extra = []): array
    {
        return $this->makeArray($extra);
    }
}
