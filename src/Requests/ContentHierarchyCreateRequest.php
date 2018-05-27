<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;

class ContentHierarchyCreateRequest extends CustomFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setGeneralRules(
            [
                'child_id' => 'required|exists:' . ConfigService::$databaseConnectionName . '.' .
                    ConfigService::$tableContent . ',id',
                'parent_id' => 'required|exists:' . ConfigService::$databaseConnectionName . '.' .
                    ConfigService::$tableContent . ',id',
                'child_position' => 'nullable|numeric|min:0'
            ]
        );

        $this->setCustomRules($this, 'fields');

        $this->validateContent($this);

        return parent::rules();
    }
}