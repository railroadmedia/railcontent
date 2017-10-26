<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;

class FieldRequest extends CustomFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //set the general validation rules
        $this->setGeneralRules([
            'key' => 'required|max:255',
            'type' => 'required|max:255',
            'position' => 'nullable|numeric|min:0',
            'content_id' => 'required|numeric|exists:'.ConfigService::$tableContent.',id'
        ]);

        //set the custom validation rules
        $this->setCustomRules($this, 'fields');

        //get all the validation rules that apply to the request
        return parent::rules();
    }
}