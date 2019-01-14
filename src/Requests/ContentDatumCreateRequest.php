<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;

class ContentDatumCreateRequest extends CustomFormRequest
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
                'position' => 'numeric|min:0',
                'content_id' => 'required|numeric|exists:' .
                    ConfigService::$databaseConnectionName .
                    '.' .
                    ConfigService::$tableContent .
                    ',id',
            ]
        );

        //set the custom validation rules
        $this->setCustomRules($this, 'datum');

        //get all the rules for the request
        return parent::rules();
    }
}