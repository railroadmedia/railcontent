<?php

namespace Railroad\Railcontent\Requests;


use Illuminate\Validation\Rule;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;

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
            'data.relationships.content.id' =>
                ['required',
                    'numeric',
                    Rule::exists(
                        ConfigService::$databaseConnectionName . '.' . ConfigService::$tableContent, 'id'
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
                    'data.attributes.user_id',
                    'data.attributes.temporary_display_name',
                    'data.relationships.content',
                    'data.relationships.parent',
                ]
        );
    }
}