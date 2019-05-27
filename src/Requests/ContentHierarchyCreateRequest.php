<?php

namespace Railroad\Railcontent\Requests;

/**
 * Class ContentHierarchyCreateRequest
 *
 * @package Railroad\Railcontent\Requests
 *
 * @bodyParam data.type string required  Must be 'contentHierarchy'. Example: contentHierarchy
 * @bodyParam data.attributes.child_position integer   The position relative to the other children of the given parent. Will automatically shift other children. If null - position will be set to the end of the child stack.
 * @bodyParam data.relationships.parent.data.type string   Must be 'content'. Example: content
 * @bodyParam data.relationships.parent.data.id integer   Must exists in contents. Example: 1
 * @bodyParam data.relationships.child.data.type string   Must be 'content'. Example: content
 * @bodyParam data.relationships.child.data.id integer   Must exists in contents. Example: 1
 */
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