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
        //set the general validation rules
        $this->setGeneralRules(
            [
               // 'id' => 'required|max:255|exists:' . ConfigService::$tableContentData . ',id',
                'key' => 'max:255',
                'position' => 'nullable|numeric|min:0',
                'content_id' => 'numeric|exists:' . ConfigService::$tableContent . ',id'
            ]
        );

        //set the custom validation rules
        $this->setCustomRules($this, 'datum');

        //get all the rules for the request
        return parent::rules();
    }
}