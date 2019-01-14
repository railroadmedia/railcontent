<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;

class ContentFieldCreateRequest extends CustomFormRequest
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
                'key' => 'required|max:255',
                'value' => 'required|nullable|max:255',
                'position' => 'required|numeric|min:0',
                'type' => 'required|max:255',
                'content_id' => 'required|numeric|exists:' .
                    ConfigService::$databaseConnectionName .
                    '.' .
                    ConfigService::$tableContent .
                    ',id',
            ]
        );

        //set the custom validation rules
        $this->setCustomRules($this, 'fields');

        //get all the validation rules that apply to the request
        return parent::rules();
    }
}