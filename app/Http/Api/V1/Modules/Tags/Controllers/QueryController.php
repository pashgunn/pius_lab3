<?php

namespace App\Http\Api\V1\Modules\Tags\Controllers;

use App\Exceptions\TagNotFoundException;
use App\Http\Api\V1\Modules\Support\Controllers\BaseController;
use App\Http\Api\V1\Modules\Tags\Queries\TagQuery;
use App\Http\Api\V1\Modules\Tags\Resources\TagResource;
use Illuminate\Http\JsonResponse;

class QueryController extends BaseController
{
    public function view(int $id, TagQuery $query): JsonResponse
    {
        try {
            $model = $query->get($id);
        } catch (TagNotFoundException $exception) {
            return $this->responseNotFound($exception->getMessage());
        }

        if (!$model) {
            return $this->responseBadRequest();
        }

        $resource = TagResource::make($model);

        return $this->responseOk($resource);
    }
}
