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
        //set the general validation rules
        $this->setGeneralRules(
            [
                'key' => 'required_without:id|max:255',
                'type' => 'required_without:id|max:255',
                'position' => 'nullable|numeric|min:0',
                'content_id' => 'required_without:id|numeric|exists:'.ConfigService::$tableContent . ',id'
            ]
        );

        //get all the validation rules that apply to the request
        return parent::rules();
    }
}