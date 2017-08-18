<?php

namespace Railroad\Railcontent\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;

class ContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug' => 'required|string|max:255',
            'status' => 'required|max:64|in:' .
                implode(
                    ',',
                    [
                        ContentService::STATUS_DRAFT,
                        ContentService::STATUS_PUBLISHED,
                        ContentService::STATUS_ARCHIVED
                    ]
                ),
            'type' => 'required|max:64',
            'position' => 'nullable|numeric|min:0',
            'parent_id' => 'nullable|numeric|exists:' . ConfigService::$tableContent . ',id',
            'published_on' => 'nullable|date',
        ];
    }
}
