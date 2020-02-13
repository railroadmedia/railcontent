<?php

namespace Railroad\Railcontent\Requests;

use Illuminate\Validation\Rule;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ResponseService;

/**
 * Class CommentCreateRequest
 *
 * @bodyParam data.type string required  Must be 'comment'. Example: comment
 * @bodyParam data.attributes.comment string required  The text of the comment. Example: Omnis doloremque reiciendis
 *     enim et autem sequi. Ut nihil hic alias sunt voluptatem aut molestiae.
 * @bodyParam data.attributes.temporary_display_name string Temporary display name for user.  Example: in
 * @bodyParam data.relationships.content.data.type string required  Must be 'content'. Example: content
 * @bodyParam data.relationships.content.data.id integer required  Must exists in contents. Example:1
 *
 * @package Railroad\Railcontent\Requests
 */
class CommentCreateRequest extends FormRequest
{
    /**
     * CommentCreateRequest constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

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
            'data.relationships.content.data.type' => 'content type',
            'data.relationships.content.data.id' => 'content id',
            'data.attributes.temporary_display_name' => 'display name'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        $availableContentStatues = config('railcontent.commentable-content-types');
        if($availableContentStatues){
            ContentRepository::$availableContentStatues = $availableContentStatues;
        }

        return [
            'data.type' => 'required|in:comment',
            'data.attributes.comment' => 'required|max:10024',
            'data.relationships.content.data.type' => 'required|in:content',
            'data.relationships.content.data.id' => 'nullable|numeric|exists:' .
                config('railcontent.table_prefix') .
                'content' .
                ',id',
            'data.relationships.content.data.id' => [
                'nullable',
                'numeric',
                Rule::exists(
                    config('railcontent.database_connection_name') .
                    '.' .
                    config('railcontent.table_prefix') .
                    'content',
                    'id'
                )
                    ->where(
                        function ($query) {
                            if (is_array(ContentRepository::$availableContentStatues)) {
                                $query->whereIn('status', ContentRepository::$availableContentStatues);
                            }
                        }
                    ),
            ],
        ];
    }

    public function onlyAllowed()
    {
        return $this->only(
            [
                'data.attributes.comment',
                'data.attributes.temporary_display_name',
                'data.relationships.content',
                'data.relationships.parent',
                'data.relationships.user',
            ]
        );
    }
}