<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;

class UserPermissionUpdateRequest extends FormRequest
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
            'user_id' => 'integer',
            'permission_id' => 'integer|exists:' . ConfigService::$databaseConnectionName . '.' .
                ConfigService::$tablePermissions . ',id',
            'start_date' => 'date',
            'expiration_date' => 'nullable|date'
        ];
    }

}