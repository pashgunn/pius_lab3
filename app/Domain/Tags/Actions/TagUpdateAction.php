<?php

namespace App\Domain\Tags\Actions;

use App\Domain\Tags\Models\Tag;
use App\Exceptions\TagNotFoundException;

class TagUpdateAction
{
    /**
     * @throws TagNotFoundException
     */
    public function execute(int $id, array $fields): ?Tag
    {
        $model = Tag::find($id);

        if (!$model) {
            throw new TagNotFoundException('News not found');
        }

        $model->update($fields);

        return $model;
    }
}
