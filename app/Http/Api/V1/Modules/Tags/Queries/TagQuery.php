<?php

namespace App\Http\Api\V1\Modules\Tags\Queries;

use App\Domain\Tags\Models\Tag;
use App\Exceptions\TagNotFoundException;

class TagQuery
{
    /**
     * @throws TagNotFoundException
     */
    public function get(int $id): ?Tag
    {
        $model = Tag::find($id);

        if (!$model) {
            throw new TagNotFoundException('News not found');
        }

        return $model;
    }
}
