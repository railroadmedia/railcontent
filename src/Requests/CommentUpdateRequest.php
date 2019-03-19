<?php

namespace Railroad\Railcontent\Requests;


use Illuminate\Validation\Rule;
use Railroad\Railcontent\Repositories\ContentRepository;


class CommentUpdateRequest extends FormRequest
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
            'data.attributes.comment' => 'nullable|max:10024',
            'data.relationships.content.data.id' =>
                ['numeric',
                    Rule::exists(
                        config('railcontent.database_connection_name') . '.' .
                        config('railcontent.table_prefix'). 'content',
                        'id'
                    )->where(
                        function ($query) {
                            if (is_array(ContentRepository::$availableContentStatues)) {
                                $query->whereIn('status', ContentRepository::$availableContentStatues);
                            }
                        }
                    )
                ],
            'data.relationships.parent.data.id' => 'numeric|exists:' . config('railcontent.database_connection_name') . '.' .
                config('railcontent.table_prefix'). 'comments' . ',id',
            'data.attributes.display_name' => 'filled'
        ];
    }

    public function onlyAllowed()
    {
        return $this->only([
            'data.attributes.comment',
            'data.attributes.display_name',
            'data.relationships.content.id',
            'data.relationships.parent.id'
        ]);
    }
}