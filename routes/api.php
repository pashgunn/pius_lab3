<?php

use App\Http\Api\V1\Modules\News\Controllers\CommandController as NewsCommandController;
use App\Http\Api\V1\Modules\News\Controllers\QueryController as NewsQueryController;
use App\Http\Api\V1\Modules\Tags\Controllers\CommandController as TagsCommandController;
use App\Http\Api\V1\Modules\Tags\Controllers\QueryController as TagsQueryController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'v1/news',
        'namespace' => 'App\\Http\\Api\\V1\\Modules\\News\\Controllers'
    ],
    function () {
        Route::get('/', [NewsQueryController::class, 'index']);
        Route::get('/{id}', [NewsQueryController::class, 'view']);
        Route::get('/{id}/tags', [NewsQueryController::class, 'getWithTags']);

        Route::post('/', [NewsCommandController::class, 'create']);
        Route::patch('/{id}', [NewsCommandController::class, 'patch']);
        Route::put('/{id}', [NewsCommandController::class, 'update']);
        Route::delete('/{id}', [NewsCommandController::class, 'delete']);
        Route::post('/{id}/tags', [NewsCommandController::class, 'syncTags']);
    }
);

Route::group(
    [
        'prefix' => 'v1/tags',
        'namespace' => 'App\\Http\\Api\\V1\\Modules\\Tags\\Controllers'
    ],
    function () {
        Route::get('/{id}', [TagsQueryController::class, 'view']);

        Route::post('/', [TagsCommandController::class, 'create']);
        Route::patch('/{id}', [TagsCommandController::class, 'patch']);
        Route::put('/{id}', [TagsCommandController::class, 'update']);
        Route::delete('/{id}', [TagsCommandController::class, 'delete']);
    }
);

Route::fallback(function () {
    return response()->json([
        'data' => null,
        'errors' => [
            'code' => 404,
            'message' => 'Route not found'
        ]], 404);
});
