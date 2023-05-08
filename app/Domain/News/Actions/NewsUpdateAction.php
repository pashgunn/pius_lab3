<?php

namespace App\Domain\News\Actions;

use App\Domain\News\Data\NewsUpdateDTO;
use App\Domain\News\Models\News;
use App\Exceptions\NewsNotFoundException;

class NewsUpdateAction
{
    /**
     * @throws NewsNotFoundException
     */
    public function execute(int $id, NewsUpdateDTO $dto): ?News
    {
        $model = News::find($id);

        if (!$model) {
            throw new NewsNotFoundException('News not found');
        }

        $model->update($dto->toArray());

        return $model;
    }
}
