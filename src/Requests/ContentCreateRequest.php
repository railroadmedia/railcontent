<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ContentService as ContentService;

class ContentCreateRequest extends CustomFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @bodyParam status string required Specific values
     * @return array
     */
    public function rules()
    {
        $this->validateContent($this);

        $this->setGeneralRules(
            [
                'data.type' => 'in:content',
                'data.attributes.status' => 'max:64|required|in:' . implode(
                        ',',
                        [
                            ContentService::STATUS_DRAFT,
                            ContentService::STATUS_PUBLISHED,
                            ContentService::STATUS_ARCHIVED,
                            ContentService::STATUS_SCHEDULED,
                            ContentService::STATUS_DELETED,
                        ]
                    ),
                'data.attributes.type' => 'required|max:64',
                'data.attributes.slug' => 'max:255',
                'data.attributes.sort' => 'nullable|numeric',
                'data.attributes.position' => 'nullable|numeric|min:0',
                'data.attributes.published_on' => 'nullable|date',
            ]
        );

        //set the custom validation rules based on content type and brand
        $this->setCustomRules($this);

        return parent::rules();
    }

    /**
     * @return array
     */
    public function onlyAllowed()
    {
        return $this->only(
            [
                'data.attributes.slug',
                'data.attributes.type',
                'data.attributes.sort',
                'data.attributes.status',
                'data.attributes.brand',
                'data.attributes.language',
                'data.attributes.published_on',
                'data.attributes.created_on',
                'data.attributes.archived_on',
                'data.attributes.fields',
                'data.relationships.parent',
                'data.relationships.user'
            ]
        );
    }
}
