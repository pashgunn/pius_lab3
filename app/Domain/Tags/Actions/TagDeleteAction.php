<?php

namespace App\Domain\Tags\Actions;

use App\Domain\Tags\Models\Tag;
use App\Exceptions\TagNotFoundException;

class TagDeleteAction
{
    /**
     * @throws TagNotFoundException
     */
    public function execute(int $id): ?bool
    {
        $model = Tag::find($id);

        if (!$model) {
            throw new TagNotFoundException('News not found');
        }

        return $model->delete();
    }
}
