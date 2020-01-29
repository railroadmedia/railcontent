<?php

namespace Railroad\Railcontent\Requests;

class StatisticsContentRequest extends FormRequest
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
            'small_date_time' => 'date',
            'big_date_time' => 'date',
            'published_on_small_date_time' => 'date',
            'published_on_big_date_time' => 'date',
            'content_types' => 'array',
            'content_types.*' => 'string|in:' . implode(',', config('railcontent.statistics_content_types')),
            'sort_by' => 'string|in:completed,started,comments,likes,added_to_list',
            'sort_dir' => 'string|in:asc,desc',
        ];
    }
}
