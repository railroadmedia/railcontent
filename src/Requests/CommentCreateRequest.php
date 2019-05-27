<?php

namespace Railroad\Railcontent\Requests;


use Illuminate\Validation\Rule;
use Railroad\Railcontent\Repositories\ContentRepository;

/**
 * Class CommentCreateRequest
 *
 * @bodyParam data.type string required  Must be 'comment'. Example: comment
 * @bodyParam data.attributes.comment string required  The text of the comment. Example: Omnis doloremque reiciendis enim et autem sequi. Ut nihil hic alias sunt voluptatem aut molestiae.
 * @bodyParam data.attributes.temporary_display_name string Temporary display name for user.  Example: in
 * @bodyParam data.relationships.content.data.type string required  Must be 'content'. Example: content
 * @bodyParam data.relationships.content.data.id integer required  Must exists in contents. Example: 1
 *
 * @package Railroad\Railcontent\Requests
 */
class CommentCreateRequest extends FormRequest
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
            'data.relationships.content.data.id' =>
                ['required',
                    'numeric',
                    Rule::exists(
                        config('railcontent.database_connection_name') . '.' . config('railcontent.table_prefix'). 'content', 'id'
                    )->where(function ($query) {
                        if (is_array(ContentRepository::$availableContentStatues)) {
                            $query->whereIn('status', ContentRepository::$availableContentStatues);
                        }
                    })
                ],
        ];
    }


    public function onlyAllowed()
    {
        return
            $this->only(
                [
                    'data.attributes.comment',
                    'data.attributes.temporary_display_name',
                    'data.relationships.content',
                    'data.relationships.parent',
                    'data.relationships.user'
                ]
        );
    }
}