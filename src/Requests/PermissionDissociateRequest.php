<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;

class PermissionDissociateRequest extends FormRequest
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
                ConfigService::$tablePermissions . ',id',
            'data.relationships.content.data.id' => 'nullable|numeric|required_without_all:data.attributes.content_type|exists:' .
                ConfigService::$databaseConnectionName . '.' .
                ConfigService::$tableContent .
                ',id',
            'data.attributes.content_type' => 'nullable|string|required_without_all:data.relationships.content.data.id|exists:' .
                ConfigService::$databaseConnectionName . '.' .
                ConfigService::$tableContent .
                ',type'
        ];
    }

//    public function attributes()
//    {
//        return [
//            'content_id' => 'content id',
//            'content_type' => 'content type',
//            'permission_id' => 'permission id'
//        ];
//
//    }

}