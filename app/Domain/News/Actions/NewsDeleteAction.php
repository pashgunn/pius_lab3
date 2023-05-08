<?php

namespace App\Domain\News\Actions;

use App\Domain\News\Models\News;
use App\Exceptions\NewsNotFoundException;

class NewsDeleteAction
{
    /**
     * @throws NewsNotFoundException
     */
    public function execute(int $id): ?bool
    {
        $model = News::find($id);

        if (!$model) {
            throw new NewsNotFoundException('News not found');
        }

        return $model->delete();
    }
}
