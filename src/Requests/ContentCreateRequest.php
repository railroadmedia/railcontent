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
                'sort' => 'nullable|numeric',
                'position' => 'nullable|numeric|min:0',
                'parent_id' => 'nullable|numeric|exists:' . ConfigService::$databaseConnectionName . '.' .
                    ConfigService::$tableContent . ',id',
                'published_on' => 'nullable|date'
            ]
        );

        //set the custom validation rules based on content type and brand
        $this->setCustomRules($this);

        //get the validation rules
        return parent::rules();
    }

    protected function contentValidationRequired()
    {
        /*
         * Can this be deleted? If the method this will override - CustomFormRequest::contentValidationRequired - needs
         * to not run in this case, then at least a comment should be added here saying as much... lest this just get
         * deleted and break something.
         *
         * Or maybe it *can* just be deleted - and not break anything?
         *
         * Jonathan, April 12
         */
    }
}
