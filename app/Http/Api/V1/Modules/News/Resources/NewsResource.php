<?php

namespace App\Http\Api\V1\Modules\News\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    public int $id;
    public string $title;
    public string $description;
    public string $body;
    public string $author;
    public string $published_at;
}
