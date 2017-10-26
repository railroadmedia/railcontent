<?php

namespace Railroad\Railcontent\Requests;


class ContentIndexRequest extends FormRequest
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
            'page' => 'numeric|min:1',
            'amount' => 'numeric|min:1',
            'order' => 'string',
            'order_by' => 'string',
            'statuses' => 'array',
            'types' => 'array',
            'fields' => 'array',
            'parent_slug' => 'string|nullable',
            'include_future_published_on' => 'boolean'
        ];
    }
}
