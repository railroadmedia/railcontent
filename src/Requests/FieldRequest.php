<?php

namespace Railroad\Railcontent\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Railroad\Railcontent\Services\ConfigService;

class FieldRequest extends FormRequest
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
            'key' => 'required|max:255',
            'value' => 'required|max:255',
            'type' => 'required|max:255',
            'position' => 'nullable|numeric|min:0',
            'content_id' => 'required|numeric|exists:' . ConfigService::$tableContent . ',id'
        ];
    }
}