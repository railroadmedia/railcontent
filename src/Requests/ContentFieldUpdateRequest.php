<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;

class ContentFieldUpdateRequest extends CustomFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->validateContent($this);

        //set the general validation rules
        $this->setGeneralRules(
            [
                'key' => 'max:255',
                'type' => 'max:255',
                'position' => 'nullable|numeric|min:0',
                'content_id' => 'numeric|exists:' . ConfigService::$tableContent . ',id'
            ]
        );

        //set the custom validation rules
        $this->setCustomRules($this, 'fields');

        //get all the validation rules that apply to the request
        return parent::rules();
    }

    protected function setContentToValidate(&$content, &$keysOfValuesRequestedToSet, &$restricted, &$input){
        $contentDatumOrField = $this->contentFieldService->get($request->request->get('id'));
        throw_if(empty($contentDatumOrField), // code-smell!
            new \Exception('$contentDatumOrField not filled in ' . '\Railroad\Railcontent\Requests\CustomFormRequest::validateContent')
        );
        $contentId = $contentDatumOrField['content_id'];
        $content = $this->contentService->getById($contentId);
        $contentType = $content['type'];
        $keysOfValuesRequestedToSet[] = $contentDatumOrField['key'];
    }
}