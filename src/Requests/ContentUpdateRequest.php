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
                'data.attributes.status' => 'max:64|in:' .
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
                'data.attributes.type' => 'max:64',
                'data.attributes.sort' => 'nullable|numeric',
                'data.attributes.position' => 'nullable|numeric|min:0',
                'data.relationships.parent.data.id' => 'nullable|numeric|exists:' . ConfigService::$databaseConnectionName . '.' .
                    ConfigService::$tableContent . ',id',
                'data.attributes.published_on' => 'nullable|date'
            ]
        );

        //set the custom validation rules based on content type and brand
        $this->setCustomRules($this);

        //get the validation rules
        return parent::rules();
    }

    /**
     * @return array
     */
    public function onlyAllowed()
    {
        return
            $this->only(
                [
                    'data.attributes.slug',
                    'data.attributes.type',
                    'data.attributes.sort',
                    'data.attributes.status',
                    'data.attributes.brand',
                    'data.attributes.language' ,
                    'data.attributes.fields',
                    'data.relationships.user'
                ]
            );
    }
}
