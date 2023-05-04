<?php

namespace App\Domain\News\Actions;

use App\Domain\News\Data\NewsCreateDTO;
use App\Domain\News\Models\News;

class NewsCreateAction
{
    public function execute(NewsCreateDTO $dto): ?News
    {
        return News::create($dto->toArray());
    }
}
