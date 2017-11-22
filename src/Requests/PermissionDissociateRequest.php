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
            'permission_id' => 'nullable|integer|exists:' . ConfigService::$tablePermissions . ',id' .
                '|required_without_all:content_type,content_permission_id',

            'content_id' => 'nullable|numeric|exists:' . ConfigService::$tableContent . ',id' .
                '|required_without_all:content_type,content_permission_id',

            'content_type' => 'nullable|string|exists:' . ConfigService::$tableContent . ',type' .
                '|required_without_all:content_id,content_permission_id',

            'content_permission_id' => 'nullable|numeric|exists:' . ConfigService::$tableContentPermissions . ',id' .
                '|required_without_all:content_type,content_id',

        ];
    }

}