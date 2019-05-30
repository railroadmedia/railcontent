<?php


namespace Railroad\Railcontent\Requests;

/**
 * Class UserContentRequest
 *
 * @package Railroad\Railcontent\Requests
 *
 * @bodyParam data.type string required  Must be 'userContentProgress'. Example: userContentProgress
 * @bodyParam data.relationships.content.data.type string required  Must be 'content'. Example: content
 * @bodyParam data.relationships.content.data.id integer required Must exists in content. Example: 1
 */
class UserContentRequest extends FormRequest
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
            'data.relationships.content.data.type' => 'content type',
            'data.relationships.content.data.id' => 'content id',
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
            'data.type' =>'required|in:userContentProgress',
            'data.relationships.content.data.type' =>'required|in:content',
            'data.relationships.content.data.id' => 'required|numeric|exists:' . config('railcontent.database_connection_name') . '.' .
                config('railcontent.table_prefix'). 'content' . ',id'
        ];
    }
}