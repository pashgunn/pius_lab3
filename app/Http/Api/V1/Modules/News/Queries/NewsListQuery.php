<?php

namespace App\Http\Api\V1\Modules\News\Queries;

use App\Domain\News\Models\News;
use Illuminate\Database\Eloquent\Collection;

class NewsListQuery
{
    public function list(): ?Collection
    {
        return News::all();
    }
}
