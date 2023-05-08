<?php

namespace App\Http\Api\V1\Modules\Tags\Controllers;

use App\Domain\Tags\Actions\TagCreateAction;
use App\Domain\Tags\Actions\TagDeleteAction;
use App\Domain\Tags\Actions\TagUpdateAction;
use App\Domain\Tags\Data\TagDTO;
use App\Exceptions\TagNotFoundException;
use App\Http\Api\V1\Modules\Support\Controllers\BaseController;
use App\Http\Api\V1\Modules\Tags\Requests\TagCreateRequest;
use App\Http\Api\V1\Modules\Tags\Requests\TagPatchRequest;
use App\Http\Api\V1\Modules\Tags\Requests\TagUpdateRequest;
use App\Http\Api\V1\Modules\Tags\Resources\TagResource;
use Illuminate\Http\JsonResponse;

class CommandController extends BaseController
{

    public function create(TagCreateRequest $request, TagCreateAction $action, TagDTO $dto): JsonResponse
    {
        $model = $action->execute($dto->build($request));

        if (!$model) {
            return $this->responseBadRequest();
        }

        $resource = TagResource::make($model);
        return $this->responseCreated($resource);
    }


    public function patch(int $id, TagPatchRequest $request, TagUpdateAction $action): JsonResponse
    {
        try {
            $model = $action->execute($id, $request->validated());
        } catch (TagNotFoundException $exception) {
            return $this->responseNotFound($exception->getMessage());
        }

        if (!$model) {
            return $this->responseBadRequest();
        }

        $resource = TagResource::make($model);

        return $this->responseOk($resource);
    }


    public function update(int $id, TagUpdateRequest $request, TagUpdateAction $action): JsonResponse
    {
        try {
            $model = $action->execute($id, $request->validated());
        } catch (TagNotFoundException $exception) {
            return $this->responseNotFound($exception->getMessage());
        }

        if (!$model) {
            return $this->responseBadRequest();
        }

        $resource = TagResource::make($model);

        return $this->responseOk($resource);
    }

    public function delete(int $id, TagDeleteAction $action): JsonResponse
    {
        try {
            $model = $action->execute($id);
        } catch (TagNotFoundException $exception) {
            return $this->responseNotFound($exception->getMessage());
        }

        if (!$model) {
            return $this->responseBadRequest();
        }

        return $this->responseOk();
    }
}
