<?php

namespace App\Domain\Tags\Data;

use App\Domain\Base\Data\BaseDTO;
use Illuminate\Http\Request;

class TagDTO extends BaseDTO
{
    public string $slug;
    public string $name;

    public function build(Request $request): self
    {
        $this->buildFromRequest($request);
        return $this;
    }
}
