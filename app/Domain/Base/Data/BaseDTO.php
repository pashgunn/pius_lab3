<?php

namespace App\Domain\Base\Data;

use Illuminate\Http\Request;

abstract class BaseDTO
{

    /**
     * @param Request $request
     * @return $this
     */
    public function buildFromRequest(Request $request): self
    {
        $properties = get_class_vars(get_class($this));
        foreach ($request->validated() as $key => $value) {
            if (array_key_exists($key, $properties)) {
                $this->$key = $value;
            }
        }

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $data = [];
        $properties = get_class_vars($this::class);
        foreach ($properties as $property => $value) {
            $data[$property] = $this->$property;
        }
        return $data;
    }
}
