<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;

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
    public function rules()
    {
        return [
            'data.relationships.user.data.id' => 'required|integer',
            'data.relationships.permission.data.id' => 'required|integer|exists:' . ConfigService::$databaseConnectionName . '.' .
                ConfigService::$tablePermissions . ',id',
            'data.attributes.start_date' => 'required|date',
            'data.attributes.expiration_date' => 'nullable|date'
        ];
    }

}