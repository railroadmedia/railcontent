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
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'data.type' => 'json data type',
            'data.attributes.start_date' => 'start date',
            'data.attributes.expiration_date' => 'expiration date',
            'data.relationships.permission.data.type' => 'permission type',
            'data.relationships.permission.data.id' => 'permission id',
            'data.relationships.user.data.type' => 'user type',
            'data.relationships.user.data.id' => 'user id',
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
            'data.type' => 'required|in:userPermission',
            'data.relationships.user.data.type' =>'required|in:user',
            'data.relationships.user.data.id' => 'required|integer',
            'data.relationships.permission.data.type' => 'required|in:permission',
            'data.relationships.permission.data.id' => 'required|integer|exists:' . config('railcontent.database_connection_name') . '.' .
                config('railcontent.table_prefix'). 'permissions' . ',id',
            'data.attributes.start_date' => 'required|date',
            'data.attributes.expiration_date' => 'nullable|date'
        ];
    }

}