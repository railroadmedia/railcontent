<?php

namespace Railroad\Railcontent\Requests;

/**
 * Class PermissionRequest
 *
 * @package Railroad\Railcontent\Requests
 *
 * @bodyParam data.type  required  Must be 'permission'. Example: permission
 * @bodyParam data.attributes.name required  Permission name. Example: Permission 1
 * @bodyParam data.attributes.brand Example: brand
 */
class PermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'data.type' => 'required|in:permission',
            'data.attributes.name' => 'required|max:255',
        ];
    }

    public function onlyAllowed()
    {
        return array_merge_recursive(
            $this->only(
                [
                    'data.attributes.name',
                ]
            ),
            [
                'data' => [
                    'attributes' => [
                        'brand' => $this->input('brand', config('railcontent.brand')),
                    ],
                ],
            ]
        );
    }
}