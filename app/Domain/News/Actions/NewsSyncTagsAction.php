<?php

namespace App\Domain\News\Actions;

use App\Domain\News\Models\News;
use App\Domain\Tags\Models\Tag;
use App\Exceptions\NewsNotFoundException;
use Illuminate\Database\Eloquent\Collection;

class NewsSyncTagsAction
{
    /**
     * @throws NewsNotFoundException
     */
    public function execute(int $id, array $fields): ?Collection
    {
        $model = News::find($id);

        if (!$model) {
            throw new NewsNotFoundException('News not found');
        }

        $tagIds = explode(',', $fields['tags']);
        $tags = Tag::whereIn('id', $tagIds)->get();
        $model->tags()->sync($tags);

        return $model->tags;
    }
}
