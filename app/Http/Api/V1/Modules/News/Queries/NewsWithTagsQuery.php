<?php

namespace App\Http\Api\V1\Modules\News\Queries;

use App\Domain\News\Models\News;
use App\Exceptions\NewsNotFoundException;
use Illuminate\Database\Eloquent\Collection;

class NewsWithTagsQuery
{
    public function get(int $id): ?Collection
    {
        $model = News::with('tags')->find($id);

        if (!$model) {
            throw new NewsNotFoundException('News not found');
        }

        return $model->tags;
    }
}
