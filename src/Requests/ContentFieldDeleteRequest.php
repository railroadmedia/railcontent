<?php

namespace Railroad\Railcontent\Requests;

class ContentFieldDeleteRequest extends CustomFormRequest
{
    /*
     * We're just doing this to call that validateContent method of CustomFormRequest... and that's a little smelly.
     * Change it if you're so inclined.
     *
     * Jonathan, February 2018
     */

    public function rules()
    {
        $this->validateContent($this);

        //get all the validation rules that apply to the request
        return parent::rules();
    }
}