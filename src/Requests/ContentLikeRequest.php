<?php


namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ResponseService;

/**
 * Class ContentLikeRequest
 *
 * @package Railroad\Railcontent\Requests
 *
 * @bodyParam data.relationships.content.data.type string  required Must be 'content'. Example: content
 * @bodyParam data.relationships.content.data.id integer  required Must exists in contents. Example: 1
 */
class ContentLikeRequest extends FormRequest
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        parent::prepareForValidation();

        $all = $this->all();
        $oldStyle = [];
        if (ResponseService::$oldResponseStructure) {
            $oldStyle ['data']['type'] = 'content';
        }

        $newParams = array_merge_recursive($all, $oldStyle);

        $this->merge($newParams);
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
            'data.relationships.content.data.type' => 'required|in:content',
            'data.relationships.content.data.id' => 'required|numeric|exists:' . config('railcontent.database_connection_name') . '.' .
                config('railcontent.table_prefix'). 'content' . ',id'
        ];
    }

    /**
     * @return array
     */
    public function onlyAllowed()
    {
        return $this->only(
            [
                'data.relationships.content'
            ]
        );
    }
}