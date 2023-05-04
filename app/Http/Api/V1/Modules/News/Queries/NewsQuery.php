<?php

namespace App\Http\Api\V1\Modules\News\Queries;

use App\Domain\News\Models\News;
use App\Exceptions\NewsNotFoundException;

class NewsQuery
{
    /**
     * @throws NewsNotFoundException
     */
    public function get(int $id): ?News
    {
        $model = News::find($id);

        if (!$model) {
            throw new NewsNotFoundException('News not found');
        }

        return $model;
    }
}
