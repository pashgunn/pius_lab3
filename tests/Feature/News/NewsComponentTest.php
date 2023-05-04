<?php

use App\Domain\News\Models\News;
use App\Http\Api\V1\Modules\News\Tests\Factories\NewsCreateRequestFactory;
use App\Http\Api\V1\Modules\News\Tests\Factories\NewsPatchRequestFactory;
use App\Http\Api\V1\Modules\News\Tests\Factories\NewsUpdateRequestFactory;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\patchJson;
use function Pest\Laravel\putJson;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\assertModelMissing;

test('POST /api/v1/news 201', function () {
    $request = NewsCreateRequestFactory::new()->make();

    postJson("/api/v1/news", $request)
        ->assertStatus(201);

    assertDatabaseHas((new News())->getTable(), [
        'title' => $request['title'],
        'description' => $request['description'],
        'body' => $request['body'],
        'author' => $request['author'],
        'published_at' => $request['published_at'],
    ]);
});

test('POST /api/v1/news 400', function () {
    $request = NewsCreateRequestFactory::new()->make();
    unset($request['title']);

    postJson("/api/v1/news/", $request)
        ->assertStatus(400);
});


test('GET /api/v1/news/{id} 200', function () {
    /** @var News $model */
    $model = News::factory()->create();

    getJson("/api/v1/news/{$model->id}")
        ->assertJsonPath('data.title', $model->title)
        ->assertStatus(200);
});

test('GET /api/v1/news/{id} 404', function () {
    $undefinedId = 1;
    getJson("/api/v1/news/{$undefinedId}")
        ->assertStatus(404);
});


test('PATCH /api/v1/news/{id} 200', function () {
    /** @var News $model */
    $model = News::factory()->create();

    $request = NewsPatchRequestFactory::new()->make();
    patchJson("/api/v1/news/{$model->id}", $request)
        ->assertJsonPath('data.author', $request['author'])
        ->assertStatus(200);

    assertDatabaseHas((new News())->getTable(), [
        'id' => $model->id,
        'author' => $request['author'],
    ]);
});

test('PATCH /api/v1/news/{id} 404', function () {
    $request = NewsPatchRequestFactory::new()->make();

    $undefinedId = 1;
    patchJson("/api/v1/news/{$undefinedId}", $request)
        ->assertStatus(404);
});


test('PUT /api/v1/news/{id} 200', function () {
    /** @var News $model */
    $model = News::factory()->create();

    $request = NewsUpdateRequestFactory::new()->make();

    putJson("/api/v1/news/{$model->id}", $request)
        ->assertStatus(200);

    assertDatabaseHas((new News())->getTable(), [
        'title' => $request['title'],
        'description' => $request['description'],
        'body' => $request['body'],
        'author' => $request['author'],
        'published_at' => $request['published_at'],
    ]);
});

test('PUT /api/v1/news/{id} 400', function () {
    $request = NewsUpdateRequestFactory::new()->make();
    unset($request['title']);

    postJson("/api/v1/news/", $request)
        ->assertStatus(400);
});

test('PUT /api/v1/news/{id} 404', function () {
    $request = NewsUpdateRequestFactory::new()->make();

    $undefinedId = 1;
    patchJson("/api/v1/news/{$undefinedId}", $request)
        ->assertStatus(404);
});


test('DELETE /api/v1/news/{id} 200', function () {
    /** @var News $model */
    $model = News::factory()->create();

    deleteJson("/api/v1/news/{$model->id}")
        ->assertStatus(200);

    assertModelMissing($model);
});

test('DELETE /api/v1/news/{id} 404', function () {
    $undefinedId = 1;
    deleteJson("/api/v1/news/{$undefinedId}")
        ->assertStatus(404);
});


test('GET /api/v1/news/{id}/tags 404', function () {
    $undefinedId = 1;
    getJson("/api/v1/news/{$undefinedId}/tags")
        ->assertStatus(404);
});


test('POST /api/v1/news/{id}/tags 404', function () {
    $undefinedId = 1;
    postJson("/api/v1/news/{$undefinedId}/tags")
        ->assertStatus(404);
});
