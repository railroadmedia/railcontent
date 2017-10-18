<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 9/7/2017
 * Time: 2:43 PM
 */

namespace Railroad\Railcontent\Requests;

use Illuminate\Foundation\Http\FormRequest;
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
            'permission_id' => 'required|integer|exists:' . ConfigService::$tablePermissions . ',id',
            'content_id' => 'nullable|numeric|required_without_all:content_type|exists:' .
                ConfigService::$tableContent .
                ',id',
            'content_type' => 'nullable|string|required_without_all:content_id|exists:' .
                ConfigService::$tableContent .
                ',type'
        ];
    }

}