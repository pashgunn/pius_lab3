<?php

namespace App\Http\Api\V1\Modules\News\Tests\Factories;

use Carbon\Carbon;
use Ensi\LaravelTestFactories\BaseApiFactory;

class NewsCreateRequestFactory extends BaseApiFactory
{
    public function definition(): array
    {
        $currentDate = Carbon::now();

        $futureDate = Carbon::tomorrow();
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->text(100),
            'body' => $this->faker->text(),
            'author' => $this->faker->name(),
            'published_at' => $this->faker->dateTimeBetween($currentDate, $futureDate)->format('Y-m-d H:i:s')
        ];
    }

    public function make(array $extra = []): array
    {
        return $this->makeArray($extra);
    }
}
