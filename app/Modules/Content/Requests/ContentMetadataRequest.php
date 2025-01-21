<?php

namespace App\Modules\Content\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentMetadataRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content_ids' => 'required|array',
            'content_ids.*' => 'exists:railcontent_content,id',
            'user' => 'nullable'
        ];
    }
}
