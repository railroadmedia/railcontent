<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;

class ContentFieldCreateRequest extends CustomFormRequest
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
                'key' => 'required|max:255',
                'type' => 'required|max:255',
                'position' => 'nullable|numeric|min:0',
                'content_id' => 'required|numeric|exists:' . ConfigService::$tableContent . ',id'
            ]
        );

        //set the custom validation rules
        $this->setCustomRules($this, 'fields');

        //get all the validation rules that apply to the request
        return parent::rules();
    }

    protected function setContentToValidate(&$content, &$keysOfValuesRequestedToSet, &$restricted, &$input){
        $contentId = $request->request->get('content_id');
        if(empty($contentId)){
            error_log('Somehow we have a ContentDatumCreateRequest or ContentFieldCreateRequest without a' .
                'content_id passed. This is at odds with what we\'re expecting and might be cause for concern');
        }
        $content = $this->contentService->getById($contentId);
        $contentType = $content['type'];
        $keysOfValuesRequestedToSet[] = $request->request->get('key');
    }
}