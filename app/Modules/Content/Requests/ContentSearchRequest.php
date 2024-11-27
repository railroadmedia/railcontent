<?php

namespace App\Modules\Content\Requests;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Brand\Enums\Status;
use App\Modules\Content\Models\Instructor;
use App\Modules\Content\Resources\Algolia\Enum\DocumentType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ContentSearchRequest extends FormRequest
{
    public function prepareForValidation(): void
    {
        // the boolean value might be sent through as the string value, so convert that into a proper boolean
        $this->merge([
            'include_future_scheduled_content_only' => match (strtolower($this->input('include_future_scheduled_content_only'))) {
                'true' => true,
                'false' => false,
                default => $this->input('include_future_scheduled_content_only'),
            },
        ]);
    }

    public function rules(): array
    {
        return [
            'term' => ['nullable', 'string'],
            'brands' => ['nullable', 'array'],
            'brands.*' => new Enum(Brand::class),
            'statuses' => ['nullable', 'array'],
            'statuses.*' => new Enum(Status::class),
            'coach_ids' => ['nullable', 'array'],
            'coach_ids.*' => ['exists:' . Instructor::class],
            'page' => ['nullable', 'integer', 'gte:0'],
            'limit' => ['nullable', 'integer', 'gte:1', 'required_with:page'],
            'sort' => ['nullable', 'string'],
            'included_types' => ['nullable', 'array'],
            'included_types.*' => new Enum(DocumentType::class),
            // TODO do we need this?
            'include_future_scheduled_content_only' => ['nullable', 'boolean'],
        ];
    }
}
