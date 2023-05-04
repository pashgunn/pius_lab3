<?php

use App\Domain\Tags\Models\Tag;
use App\Http\Api\V1\Modules\Tags\Tests\Factories\TagCreateRequestFactory;
use App\Http\Api\V1\Modules\Tags\Tests\Factories\TagPatchRequestFactory;
use App\Http\Api\V1\Modules\Tags\Tests\Factories\TagUpdateRequestFactory;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\patchJson;
use function Pest\Laravel\putJson;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\assertModelMissing;


test('POST /api/v1/tags 201', function () {
    $request = TagCreateRequestFactory::new()->make();

    postJson("/api/v1/tags", $request)
        ->assertStatus(201);

    assertDatabaseHas((new Tag())->getTable(), [
        'slug' => $request['slug'],
        'name' => $request['name'],
    ]);
});

test('POST /api/v1/tags 400', function () {
    $request = TagCreateRequestFactory::new()->make();
    unset($request['slug']);

    postJson("/api/v1/tags", $request)
        ->assertStatus(400);
});


test('GET /api/v1/tags/{id} 200', function () {
    /** @var Tag $model */
    $model = Tag::factory()->create();

    getJson("/api/v1/tags/{$model->id}")
        ->assertJsonPath('data.slug', $model->slug)
        ->assertJsonPath('data.name', $model->name)
        ->assertStatus(200);
});

test('GET /api/v1/tags/{id} 404', function () {
    $undefinedId = 1;
    getJson("/api/v1/tags/{$undefinedId}")
        ->assertStatus(404);
});


test('PATCH /api/v1/tags/{id} 200', function () {
    /** @var Tag $model */
    $model = Tag::factory()->create();

    $request = TagPatchRequestFactory::new()->make();

    patchJson("/api/v1/tags/{$model->id}", $request)
        ->assertJsonPath('data.name', $request['name'])
        ->assertStatus(200);

    assertDatabaseHas((new Tag())->getTable(), [
        'id' => $model->id,
        'name' => $request['name'],
    ]);
});

test('PATCH /api/v1/tags/{id} 404', function () {
    $request = TagPatchRequestFactory::new()->make();

    $undefinedId = 1;
    patchJson("/api/v1/tags/{$undefinedId}", $request)
        ->assertStatus(404);
});


test('PUT /api/v1/tags/{id} 200', function () {
    /** @var Tag $model */
    $model = Tag::factory()->create();

    $request = TagUpdateRequestFactory::new()->make();

    putJson("/api/v1/tags/{$model->id}", $request)
        ->assertStatus(200);

    assertDatabaseHas((new Tag())->getTable(), [
        'slug' => $request['slug'],
        'name' => $request['name'],
    ]);
});

test('PUT /api/v1/tags/{id} 400', function () {
    $request = TagUpdateRequestFactory::new()->make();
    unset($request['slug']);

    postJson("/api/v1/tags", $request)
        ->assertStatus(400);
});

test('PUT /api/v1/tags/{id} 404', function () {
    $request = TagUpdateRequestFactory::new()->make();

    $undefinedId = 1;
    patchJson("/api/v1/tags/{$undefinedId}", $request)
        ->assertStatus(404);
});


test('DELETE /api/v1/tags/{id} 200', function () {
    /** @var Tag $model */
    $model = Tag::factory()->create();

    deleteJson("/api/v1/tags/{$model->id}")
        ->assertStatus(200);

    assertModelMissing($model);
});

test('DELETE /api/v1/tags/{id} 404', function () {
    $undefinedId = 1;
    deleteJson("/api/v1/tags/{$undefinedId}")
        ->assertStatus(404);
});
