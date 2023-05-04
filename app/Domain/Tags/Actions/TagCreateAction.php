<?php

namespace App\Domain\Tags\Actions;

use App\Domain\Tags\Data\TagDTO;
use App\Domain\Tags\Models\Tag;

class TagCreateAction
{
    public function execute(TagDTO $dto): ?Tag
    {
        return Tag::create($dto->toArray());
    }
}
