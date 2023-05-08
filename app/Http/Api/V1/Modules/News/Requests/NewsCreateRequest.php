<?php

namespace App\Http\Api\V1\Modules\News\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class NewsCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|unique:news,title|string|max:50',
            'description' => 'required|string|max:100',
            'body' => 'required|string|max:255',
            'author' => 'required|string',
            'published_at' => 'nullable|after_or_equal:today|date_format:Y-m-d H:i:s',
//            'tag_id' => 'nullable|integer|'
        ];
    }
}
