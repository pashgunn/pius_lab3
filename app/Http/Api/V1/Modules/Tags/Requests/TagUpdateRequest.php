<?php

namespace App\Http\Api\V1\Modules\Tags\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TagUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'slug' => 'string|required|unique:tags,slug',
            'name' => 'string|required'
        ];
    }
}
