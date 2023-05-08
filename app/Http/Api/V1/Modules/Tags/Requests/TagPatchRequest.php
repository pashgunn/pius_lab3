<?php

namespace App\Http\Api\V1\Modules\Tags\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagPatchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'slug' => 'string|unique:tags,slug',
            'name' => 'string'
        ];
    }
}
