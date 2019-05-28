<?php

namespace Railroad\Railcontent\Requests;

/**
 * Class ReplyRequest
 *
 * @package Railroad\Railcontent\Requests
 *
 * @bodyParam data.type string required  Must be 'comment'. Example: comment
 * @bodyParam data.attributes.comment string required  The text of the reply. Example: Omnis doloremque reiciendis enim et autem sequi. Ut nihil hic alias sunt voluptatem aut molestiae.
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'data.attributes.comment' => 'required|max:10024',
            'data.relationships.parent.data.id' => 'required|numeric|exists:' .
                config('railcontent.database_connection_name') .
                '.' .
                config('railcontent.table_prefix'). 'comments' .
                ',id'
        ];
    }
}