<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;

class ContentHierarchyUpdateRequest extends CustomFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setGeneralRules(
            [
                'child_position' => 'required|numeric|min:0'
            ]
        );

        $this->setCustomRules($this, 'fields');

        return parent::rules();
    }
}