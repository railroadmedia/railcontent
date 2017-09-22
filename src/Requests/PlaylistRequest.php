<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 9/22/2017
 * Time: 2:26 PM
 */

namespace Railroad\Railcontent\Requests;


use Illuminate\Foundation\Http\FormRequest;

class PlaylistRequest extends FormRequest
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
            'name' => 'required|max:255'
        ];
    }
}