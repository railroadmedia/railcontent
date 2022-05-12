<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;

class ContentBpmCreateRequest extends FormRequest
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
            'value' => 'required|string',
            'content_id' => 'required|numeric|exists:' . ConfigService::$databaseConnectionName . '.' .
                ConfigService::$tableContent . ',id'
        ];
    }
}