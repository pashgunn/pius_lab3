<?php

namespace App\Http\Api\V1\Modules\News\Controllers;

use App\Exceptions\NewsNotFoundException;
use App\Http\Api\V1\Modules\News\Queries\NewsListQuery;
use App\Http\Api\V1\Modules\News\Queries\NewsQuery;
use App\Http\Api\V1\Modules\News\Queries\NewsWithTagsQuery;
use App\Http\Api\V1\Modules\News\Resources\NewsResource;
use App\Http\Api\V1\Modules\Support\Controllers\BaseController as BaseController;
use App\Http\Api\V1\Modules\Tags\Resources\TagResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class QueryController extends BaseController
{
    public function index(NewsListQuery $query): JsonResponse
    {
        $collection = $query->list();

        if (!$collection) {
            return $this->responseBadRequest();
        }

        $result = [];
        foreach ($collection as $model) {
            $resource = NewsResource::make($model);
            $result[] = $resource;
        }

        $resource = new JsonResource($result);

        return $this->responseOk($resource);
    }

    public function view(int $id, NewsQuery $query): JsonResponse
    {
        try {
            $model = $query->get($id);
        } catch (NewsNotFoundException $exception) {
            return $this->responseNotFound($exception->getMessage());
        }

        if (!$model) {
            return $this->responseBadRequest();
        }

        $resource = NewsResource::make($model);

        return $this->responseOk($resource);
    }

    public function getWithTags(int $id, NewsWithTagsQuery $query): JsonResponse
    {
        try {
            $model = $query->get($id);
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
