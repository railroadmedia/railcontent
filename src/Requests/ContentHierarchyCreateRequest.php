<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ResponseService;

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
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'data.type' => 'json data type',
            'data.attributes.child_position' => 'child position',
            'data.relationships.parent.data.type' => 'parent type',
            'data.relationships.parent.data.id' => 'parent id',
            'data.relationships.child.data.type' => 'child type',
            'data.relationships.child.data.id' => 'child id',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setGeneralRules(
            [
                'data.type' => 'required|in:contentHierarchy',
                'data.relationships.child.data.type' => 'required|in:content',
                'data.relationships.child.data.id' => 'required|exists:' . config('railcontent.database_connection_name') . '.' .
                    config('railcontent.table_prefix'). 'content' . ',id',
                'data.relationships.parent.data.type' => 'required|in:content',
                'data.relationships.parent.data.id' => 'required|exists:' . config('railcontent.database_connection_name') . '.' .
                    config('railcontent.table_prefix'). 'content'. ',id',
                'data.attributes.child_position' => 'nullable|numeric|min:0'
            ]
        );

        $this->setCustomRules($this, 'fields');

        $this->validateContent($this);

        return parent::rules();
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        parent::prepareForValidation();

        $all = $this->all();
        $oldStyle = [];
        if (ResponseService::$oldResponseStructure) {
            $oldStyle ['data']['type'] = 'contentHierarchy';

            if (array_key_exists('parent_id', $all)) {
                $oldStyle['data']['relationships']['parent'] = [
                    'data' => [
                        'type' => 'content',
                        'id' => $all['parent_id'] ?? 0,
                    ],
                ];
            }

            if (array_key_exists('child_id', $all)) {
                $oldStyle['data']['relationships']['child'] = [
                    'data' => [
                        'type' => 'content',
                        'id' => $all['child_id'] ?? 0,
                    ],
                ];
            }
        }

        $newParams = array_merge_recursive($all, $oldStyle);

        $this->merge($newParams);
    }
}