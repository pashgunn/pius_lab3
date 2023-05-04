<?php

namespace App\Http\Api\V1\Modules\Tags\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    public string $slug;
    public string $name;
}
