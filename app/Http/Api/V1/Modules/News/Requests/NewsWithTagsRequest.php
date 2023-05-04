<?php

namespace App\Http\Api\V1\Modules\News\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsWithTagsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'tags' => 'nullable|string'
        ];
    }
}
