<?php

namespace App\Http\Api\V1\Modules\Support\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class BaseController
{
    protected function responseOk(JsonResource $data = null): JsonResponse
    {
        return response()->json(['data' => $data])->setStatusCode(Response::HTTP_OK);
    }

    protected function responseCreated(JsonResource $data): JsonResponse
    {
        return response()->json(['data' => $data])->setStatusCode(Response::HTTP_CREATED);
    }

    protected function responseBadRequest(string $message = "Bad operation"): JsonResponse
    {
        return response()->json(['data' => $message])->setStatusCode(Response::HTTP_BAD_REQUEST);
    }

    protected function responseNotFound(string $message): JsonResponse
    {
        return response()->json(['data' => null, 'errors' => $message])->setStatusCode(Response::HTTP_NOT_FOUND);
    }

    protected function responseInternalServerError(string $message): JsonResponse
    {
        return response()->json(['data' => $message])->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
