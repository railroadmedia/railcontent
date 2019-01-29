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
                'data.relationships.child.id' => 'required|exists:' . ConfigService::$databaseConnectionName . '.' .
                    ConfigService::$tableContent . ',id',
                'data.relationships.parent.id' => 'required|exists:' . ConfigService::$databaseConnectionName . '.' .
                    ConfigService::$tableContent . ',id',
                'data.attributes.child_position' => 'nullable|numeric|min:0'
            ]
        );

        $this->setCustomRules($this, 'fields');

//        $this->validateContent($this);

        return parent::rules();
    }

//    public function attributes()
//    {
//        return [
//            'child_id' => 'child id',
//            'child_position' => 'child position',
//            'parent_id' => 'parent id'
//        ];
//
//    }
}