<?php

namespace App\Http\Api\V1\Modules\News\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsPatchRequest  extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'unique:news,title|string|max:50',
            'description' => 'string|max:100',
            'body' => 'string|max:255',
            'author' => 'string',
            'published_at' => 'nullable|after_or_equal:today|date_format:Y-m-d H:i:s'
        ];
    }
}
