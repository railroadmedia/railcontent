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
            'brand' => 'string',
            'content_types' => 'array',
            'content_types.*' => 'string|in:' . implode(',', config('railcontent.statistics_content_types')),
            'sort_by' => 'string|in:content_id,content_type,content_published_on,total_completes,total_starts,total_comments,total_likes,total_added_to_list',
            'sort_dir' => 'string|in:asc,desc',
            'stats_epoch' => 'numeric',
        ];
    }
}