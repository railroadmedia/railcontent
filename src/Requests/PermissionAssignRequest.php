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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'data.relationships.permission.data.id' => 'required|integer|exists:' . config('railcontent.database_connection_name') . '.' .
                config('railcontent.table_prefix'). 'permissions' . ',id',
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