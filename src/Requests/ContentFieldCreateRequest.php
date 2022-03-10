<?php

namespace Railroad\Railcontent\Requests;


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
                'key' => 'required|max:255',
                'type' => 'required_without:id|max:255',
                'position' => 'nullable|numeric|min:0',
                'content_id' => 'required_without:id|numeric|exists:'.config('railcontent.database_connection_name') . '.' .
                    config('railcontent.table_prefix'). 'content' . ',id'
            ]
        );

        //get all the validation rules that apply to the request
        return parent::rules();
    }

    public function onlyAllowed()
    {
        return
            $this->only(
                [
                    'key',
                    'value',
                    'position'
                ]
            );
    }
}