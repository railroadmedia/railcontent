<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService as ContentService;

class ContentUpdateRequest extends CustomFormRequest
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
                'type' => 'max:64',
                'sort' => 'nullable|numeric',
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
        $urlPath = parse_url($_SERVER['HTTP_REFERER'])['path'];
        $urlPath = explode('/', $urlPath);

        // if this is equal to content-type continue, else error
        $urlPathThirdLastElement = array_values(array_slice($urlPath, -3))[0];

        // if this is edit continue, else error
        $urlPathSecondLastElement = array_values(array_slice($urlPath, -2))[0];

        if($urlPathSecondLastElement !== 'edit'){
            error_log(
                'Attempting to validate content-update, but url path\'s second-last element does not ' .
                'match expectations. (expected "edit", got "' . $urlPathSecondLastElement . '")'
            );
        }

        // content_id
        $urlPathLastElement = array_values(array_slice($urlPath, -1))[0];

        $contentId = (integer) $urlPathLastElement;
        $content = $this->contentService->getById($contentId);
        $contentType = $content['type'];

        if($urlPathThirdLastElement !== $contentType){
            error_log(
                'Attempting to validate content-update, but url path\'s third-last element does not ' .
                'match expectations. (expected "' . $contentType . '", got "' . $urlPathSecondLastElement . '")'
            );
        }
    }

    protected function prepareForContentValidation(&$content, &$keysOfValuesRequestedToSet, &$restricted, &$input){
        $restrictedAttemptedToSet = false;

        foreach($input as $inputKey => $inputValue){
            if(in_array($inputKey, $restricted)){
                $restrictedAttemptedToSet = true;
            }
            $keysOfValuesRequestedToSet[] = $inputKey;
        }

        if(!$restrictedAttemptedToSet){
            /*
             * No need to validate - the user is just updating or setting a content attribute that is not
             * disallowed for invalid contents and thus must not be protected.
             *
             * Jonathan, January 2018
             */

            // todo: adjust so that this triggers exiting the content-validation. If we get here it means we don't need to validate
            return true;
        }
    }
}
