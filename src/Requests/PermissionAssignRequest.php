<?php

namespace Railroad\Railcontent\Requests;


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
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'data.type' => 'json data type',
            'data.attributes.content_type' => 'content type',
            'data.relationships.permission.data.type' => 'permission type',
            'data.relationships.permission.data.id' => 'permission id',
            'data.relationships.content.data.type' => 'content type',
            'data.relationships.content.data.id' => 'content id',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'data.type' => 'required|in:contentPermission',
            'data.relationships.permission.data.type' => 'required|in:permission',
            'data.relationships.permission.data.id' => 'required|integer|exists:' . config('railcontent.database_connection_name') . '.' .
                config('railcontent.table_prefix'). 'permissions' . ',id',
            'data.relationships.content.data.type' => 'nullable|in:content|required_without_all:data.attributes.content_type',
            'data.relationships.content.data.id' => 'nullable|numeric|required_without_all:data.attributes.content_type|exists:' .
                config('railcontent.database_connection_name') . '.' .
                config('railcontent.table_prefix'). 'content' .
                ',id',
            'data.attributes.content_type' => 'nullable|string|required_without_all:data.relationships.content.data.id|exists:' .
                config('railcontent.database_connection_name') . '.' .
                config('railcontent.table_prefix'). 'content' .
                ',type'
        ];
    }
}