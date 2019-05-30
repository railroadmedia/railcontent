<?php

namespace Railroad\Railcontent\Requests;

/**
 * Class UserPermissionCreateRequest
 *
 * @package Railroad\Railcontent\Requests
 *
 * @bodyParam data.type string required  Must be 'userPermission'. Example: userPermission
 * @bodyParam data.attributes.start_date required  Permission name. Example: Permission 1
 * @bodyParam data.attributes.expiration_date   If expiration date is null they have access forever; otherwise the user have access until the expiration date. Example: 2019-06-01
 * @bodyParam data.relationships.permission.data.type string required  Must be 'permission'. Example: permission
 * @bodyParam data.relationships.permission.data.id integer required Must exists in permission. Example: 1
 * @bodyParam data.relationships.user.data.type string required  Must be 'user'. Example: user
 * @bodyParam data.relationships.user.data.id integer required Must exists in user. Example: 1
 */
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