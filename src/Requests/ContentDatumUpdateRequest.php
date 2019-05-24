<?php

namespace Railroad\Railcontent\Requests;



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
                'data.attributes.key' => 'max:255',
                'data.attributes.position' => 'nullable|numeric|min:0'
            ]
        );

        //set the custom validation rules
        $this->setCustomRules($this, 'datum');

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
                    'data.attributes.position'
                ]
            );
    }
}