<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ResponseService;

/**
 * Class ReplyRequest
 *
 * @package Railroad\Railcontent\Requests
 *
 * @bodyParam data.type string required  Must be 'comment'. Example: comment
 * @bodyParam data.attributes.comment string required  The text of the reply. Example: Omnis doloremque reiciendis enim
 *     et autem sequi. Ut nihil hic alias sunt voluptatem aut molestiae.
 * @bodyParam data.relationships.parent.data.type string required  Must be 'comment'. Example: comment
 * @bodyParam data.relationships.parent.data.id integer required  Must exists in comments. Example: 1
 */
class ReplyRequest extends FormRequest
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
            $oldStyle ['data']['type'] = 'comment';

            if (array_key_exists('parent_id', $all)) {
                $oldStyle['data']['relationships']['parent'] = [
                    'data' => [
                        'type' => 'comment',
                        'id' => $all['parent_id'] ?? 0,
                    ],
                ];
            }
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
            'data.attributes.comment' => 'comment',
            'data.relationships.parent.data.type' => 'parent type',
            'data.relationships.parent.data.id' => 'parent id',
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
            'data.type' => 'required|in:comment',
            'data.attributes.comment' => 'required|max:10024',
            'data.relationships.parent.data.type' => 'required|in:comment',
            'data.relationships.parent.data.id' => 'required|numeric|exists:' .
                config('railcontent.database_connection_name') .
                '.' .
                config('railcontent.table_prefix') .
                'comments' .
                ',id',
        ];
    }
}