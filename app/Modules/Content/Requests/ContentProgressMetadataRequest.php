<?php

namespace App\Modules\Content\Requests;

use App\Modules\Brand\Enums\Brand;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ContentProgressMetadataRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content_type' => 'nullable|string',
            'brand' => ['nullable',  new Enum(Brand::class)],
            'user' => 'nullable',
            'page' => ['nullable', 'integer', 'gte:1'],
            'limit' => ['nullable', 'integer', 'gte:1', 'required_with:page'],
        ];
    }
}
