<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ContentService as ContentService;

/**
 * Class ContentCreateRequest
 *
 * @package Railroad\Railcontent\Requests
 *
 * @bodyParam data.type string required  Must be 'content'. Example: content
 * @bodyParam data.attributes.slug string Example:01-getting-started
 * @bodyParam data.attributes.type string required Example:course
 * @bodyParam data.attributes.status string required Example:draft
 * @bodyParam data.attributes.language   By default:'en-US'. Example: en-US
 * @bodyParam data.attributes.sort integer Example:1
 * @bodyParam data.attributes.published_on datetime Example:2019-05-21 21:20:10
 * @bodyParam data.attributes.created_on datetime Example:2019-05-21 21:20:10
 * @bodyParam data.attributes.archived_on datetime Example:2019-05-21 21:20:10
 * @bodyParam data.attributes.fields array
 * @bodyParam data.attributes.brand string Example:brand
 * @bodyParam data.relationships.parent.data.type string   Must be 'content'. Example: content
 * @bodyParam data.relationships.parent.data.id integer   Must exists in contents. Example: 1
 * @bodyParam data.relationships.user.data.type string   Must be 'user'. Example: user
 * @bodyParam data.relationships.user.data.id integer   Must exists in user. Example: 1
 */
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
                'data.type' => 'required|in:content',
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
                'data.relationships.parent.data.type' => 'nullable|in:content',
                'data.relationships.user.data.type' => 'nullable|in:user',
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
                'data.relationships.user',
            ]
        );
    }
}
