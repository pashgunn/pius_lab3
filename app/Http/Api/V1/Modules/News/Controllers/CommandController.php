<?php

namespace App\Http\Api\V1\Modules\News\Controllers;

use App\Domain\News\Actions\NewsCreateAction;
use App\Domain\News\Actions\NewsDeleteAction;
use App\Domain\News\Actions\NewsPatchAction;
use App\Domain\News\Actions\NewsSyncTagsAction;
use App\Domain\News\Actions\NewsUpdateAction;
use App\Domain\News\Data\NewsCreateDTO;
use App\Domain\News\Data\NewsUpdateDTO;
use App\Exceptions\NewsNotFoundException;
use App\Http\Api\V1\Modules\News\Requests\NewsCreateRequest;
use App\Http\Api\V1\Modules\News\Requests\NewsPatchRequest;
use App\Http\Api\V1\Modules\News\Requests\NewsUpdateRequest;
use App\Http\Api\V1\Modules\News\Requests\NewsWithTagsRequest;
use App\Http\Api\V1\Modules\News\Resources\NewsResource;
use App\Http\Api\V1\Modules\Support\Controllers\BaseController as BaseController;
use App\Http\Api\V1\Modules\Tags\Resources\TagResource;
use Illuminate\Http\JsonResponse;

class CommandController extends BaseController
{

    public function create(NewsCreateRequest $request, NewsCreateAction $action, NewsCreateDTO $dto): JsonResponse
    {
        $model = $action->execute($dto->build($request));

        if (!$model) {
            return $this->responseBadRequest();
        }

        $resource = NewsResource::make($model);
        return $this->responseCreated($resource);
    }


    public function patch(int $id, NewsPatchRequest $request, NewsPatchAction $action): JsonResponse
    {
        try {
            $model = $action->execute($id, $request->validated());
        } catch (NewsNotFoundException $exception) {
            return $this->responseNotFound($exception->getMessage());
        }

        if (!$model) {
            return $this->responseBadRequest();
        }

        $resource = NewsResource::make($model);

        return $this->responseOk($resource);
    }


    public function update(int $id, NewsUpdateRequest $request, NewsUpdateAction $action, NewsUpdateDTO $dto): JsonResponse
    {
        try {
            $model = $action->execute($id, $dto->build($request));
        } catch (NewsNotFoundException $exception) {
            return $this->responseNotFound($exception->getMessage());
        }

        if (!$model) {
            return $this->responseBadRequest();
        }

        $resource = NewsResource::make($model);

        return $this->responseOk($resource);
    }

    public function delete(int $id, NewsDeleteAction $action): JsonResponse
    {
        try {
            $model = $action->execute($id);
        } catch (NewsNotFoundException $exception) {
            return $this->responseNotFound($exception->getMessage());
        }

        if (!$model) {
            return $this->responseBadRequest();
        }

        return $this->responseOk();
    }

    public function syncTags(int $id, NewsWithTagsRequest $request, NewsSyncTagsAction $action): JsonResponse
    {
        try {
            $model = $action->execute($id, $request->validated());
        } catch (NewsNotFoundException $exception) {
            return $this->responseNotFound($exception->getMessage());
        }

        if (!$model) {
            return $this->responseBadRequest();
        }

        $resource = TagResource::make($model);

        return $this->responseOk($resource);
    }
}
