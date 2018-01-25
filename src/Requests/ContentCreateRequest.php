<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService as ContentService;

class ContentCreateRequest extends CustomFormRequest
{
    protected $generalRules;

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
                'status' => 'max:64|in:' .
                    implode(
                        ',',
                        [
                            ContentService::STATUS_DRAFT,
                            ContentService::STATUS_PUBLISHED,
                            ContentService::STATUS_ARCHIVED,
                            ContentService::STATUS_SCHEDULED,
                            ContentService::STATUS_DELETED,
                        ]
                    ),
                'type' => 'required|max:64',
                'position' => 'nullable|numeric|min:0',
                'parent_id' => 'nullable|numeric|exists:' . ConfigService::$tableContent . ',id',
                'published_on' => 'nullable|date'
            ]
        );

        //set the custom validation rules based on content type and brand
        $this->setCustomRules($this);

        //get the validation rules
        return parent::rules();
    }

    protected function setContentToValidate(&$content, &$keysOfValuesRequestedToSet, &$restricted, &$input){
        $contentType['type'] = $input['type'];
    }

    protected function prepareForContentValidation(&$content, &$keysOfValuesRequestedToSet, &$restricted, &$input){
        foreach($input as $inputKey => $inputValue){
            if(in_array($inputKey, $restricted)){
                throw new \Exception(
                    'Trying to create new content and passing a value that is protected by the ' .
                    'content validation system ("' . $inputKey . '" is restricted and thus cannot be set on ' .
                    'create). This value should not be sent in create requests such as this. It happening is ' .
                    'likely due to an incorrectly configured form.'
                );
            }
            $keysOfValuesRequestedToSet[] = $inputKey;
        }
        /*
         * No need to validate - the user is just creating the content and thus of course it won't pass, and
         * we know they're not setting a value that would set it live.
         *
         * Jonathan, January 2018
         */

        // todo: adjust so that this triggers exiting the content-validation. If we get here it means we don't need to validate
        return true;
    }
}
