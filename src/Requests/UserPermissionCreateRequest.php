<?php

namespace Railroad\Railcontent\Requests;


class UserPermissionCreateRequest extends FormRequest
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
            'data.type' => 'in:userPermission',
            'data.relationships.user.data.type' =>'in:user',
            'data.relationships.user.data.id' => 'required|integer',
            'data.relationships.permission.data.type' => 'in:permission',
            'data.relationships.permission.data.id' => 'required|integer|exists:' . config('railcontent.database_connection_name') . '.' .
                config('railcontent.table_prefix'). 'permissions' . ',id',
            'data.attributes.start_date' => 'required|date',
            'data.attributes.expiration_date' => 'nullable|date'
        ];
    }

}