<?php

namespace App\Domain\News\Data;

use App\Domain\Base\Data\BaseDTO;
use Illuminate\Http\Request;

class NewsUpdateDTO extends BaseDTO
{
    public string $title;
    public string $description;
    public string $body;
    public string $author;
    public string $published_at;

    public function build(Request $request): self
    {
        $this->buildFromRequest($request);
        return $this;
    }
}
