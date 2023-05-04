<?php

use Tests\TestCase;

use function Pest\Laravel\getJson;

$headers = [
    'Content-type' => 'application/json',
    'Accept' => 'application/json',
];

test('GET /api/v1/not-existing-resource returns correct error response', function () use ($headers) {
    $response = getJson("/api/v1/not-existing-resource");

    $response->assertStatus(404);
    $response->assertJson([
        'data' => null,
        'errors' => [
            'code' => 404,
            'message' => 'Route not found'
        ]
    ]);
});
