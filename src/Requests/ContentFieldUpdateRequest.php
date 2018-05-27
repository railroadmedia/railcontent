<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;

class ContentFieldUpdateRequest extends CustomFormRequest
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
                'key' => 'max:255',
                'type' => 'max:255',
                'position' => 'nullable|numeric|min:0',
                'content_id' => 'numeric|exists:' . ConfigService::$databaseConnectionName . '.' .
                    ConfigService::$tableContent . ',id'
            ]
        );

        //set the custom validation rules
        $this->setCustomRules($this, 'fields');

        //get all the validation rules that apply to the request
        return parent::rules();
    }
}