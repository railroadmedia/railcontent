<?php

namespace Railroad\Railcontent\Requests;

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
    public function rules()
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