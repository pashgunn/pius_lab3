<?php

namespace App\Domain\News\Actions;

use App\Domain\News\Models\News;
use App\Exceptions\NewsNotFoundException;

class NewsPatchAction
{
    /**
     * @throws NewsNotFoundException
     */
    public function execute(int $id, array $fields): ?News
    {
        $model = News::find($id);

        if (!$model) {
            throw new NewsNotFoundException('News not found');
        }

        $model->update($fields);

        return $model;
    }
}
