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
        ];
    }
}
