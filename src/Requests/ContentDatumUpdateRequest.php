<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;

class ContentDatumUpdateRequest extends CustomFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->validateContent($this);

        //set the general validation rules
        $this->setGeneralRules(
            [
               // 'id' => 'required|max:255|exists:' . ConfigService::$tableContentData . ',id',
                'data.attributes.key' => 'max:255',
                'data.attributes.position' => 'nullable|numeric|min:0',
                'data.relationships.content.data.id' => 'numeric|exists:' . ConfigService::$databaseConnectionName . '.' .
                    config('railcontent.table_prefix'). 'content' . ',id'
            ]
        );

        //set the custom validation rules
        $this->setCustomRules($this, 'data');

        //get all the rules for the request
        return parent::rules();
    }

    public function onlyAllowed()
    {
        return
            $this->only(
                [
                    'data.attributes.key',
                    'data.attributes.value',
                    'data.attributes.position',
                    'data.relationships.content'
                ]
            );
    }
}