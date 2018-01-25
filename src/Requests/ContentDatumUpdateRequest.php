<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;

class ContentDatumUpdateRequest extends CustomFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //set the general validation rules
        $this->setGeneralRules(
            [
               // 'id' => 'required|max:255|exists:' . ConfigService::$tableContentData . ',id',
                'key' => 'max:255',
                'position' => 'nullable|numeric|min:0',
                'content_id' => 'numeric|exists:' . ConfigService::$tableContent . ',id'
            ]
        );

        //set the custom validation rules
        $this->setCustomRules($this, 'datum');

        $this->validateContent($this);

        //get all the rules for the request
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