<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;

class ContentBpmUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'position' => 'nullable|numeric|min:0',
            'value' => 'nullable|string',
            'content_id' => 'numeric|exists:' . ConfigService::$databaseConnectionName . '.' .
                ConfigService::$tableContent . ',id'
        ];
    }
}