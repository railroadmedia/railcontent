<?php

namespace Railroad\Railcontent\Requests;

class ContentHierarchyCreateRequest extends CustomFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setGeneralRules(
            [
                'data.relationships.child.data.id' => 'required|exists:' . config('railcontent.database_connection_name') . '.' .
                    config('railcontent.table_prefix'). 'content' . ',id',
                'data.relationships.parent.data.id' => 'required|exists:' . config('railcontent.database_connection_name') . '.' .
                    config('railcontent.table_prefix'). 'content'. ',id',
                'data.attributes.child_position' => 'nullable|numeric|min:0'
            ]
        );

        $this->setCustomRules($this, 'fields');

        $this->validateContent($this);

        return parent::rules();
    }
}