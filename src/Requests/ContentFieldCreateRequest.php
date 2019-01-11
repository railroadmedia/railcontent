<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Entities\Content;
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
        //$this->validateContent($this);

        //set the general validation rules
        $this->setGeneralRules(
            [
                'key' => 'required_without:id|max:255',
                'type' => 'required_without:id|max:255',
                'position' => 'nullable|numeric|min:0',
                'content_id' => 'required_without:id|numeric|exists:'.ConfigService::$tableContent . ',id'
            ]
        );


        //set the custom validation rules
       // $this->setCustomRules($this, 'fields');

        //get all the validation rules that apply to the request
        return parent::rules();
    }
}