<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;

class PermissionAssignRequest extends FormRequest
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
    public function rules()
    {
        return [
            'data.relationships.permission.data.id' => 'required|integer|exists:' . ConfigService::$databaseConnectionName . '.' .
                config('railcontent.table_prefix'). 'permissions' . ',id',
            'data.relationships.content.data.id' => 'nullable|numeric|required_without_all:data.attributes.content_type|exists:' .
                ConfigService::$databaseConnectionName . '.' .
                config('railcontent.table_prefix'). 'content' .
                ',id',
            'data.attributes.content_type' => 'nullable|string|required_without_all:data.relationships.content.data.id|exists:' .
                ConfigService::$databaseConnectionName . '.' .
                config('railcontent.table_prefix'). 'content' .
                ',type'
        ];
    }

//    /**
//     * @return array
//     */
//    public function onlyAllowed()
//    {
//        return array_merge(
//            $this->only(
//                [
//                    'data.attributes.content_type',
//                    'data.relationships.content',
//                    'data.relationships.permission',
//                ]
//            )
//        );
//    }
}