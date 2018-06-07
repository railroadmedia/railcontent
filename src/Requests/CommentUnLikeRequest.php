<?php

namespace Railroad\Railcontent\Requests;

use Illuminate\Foundation\Http\FormRequest;

/*
 * I'm unsure what class to extend here - particularily if there's a reason to use the railcontent request verions
 *
*/

class CommentUnLikeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }
}