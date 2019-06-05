<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ContentService as ContentService;

/**
 * Class ContentUpdateRequest
 *
 * @package Railroad\Railcontent\Requests
 *
 * @bodyParam data.type string required  Must be 'content'. Example: content
 * @bodyParam data.attributes.slug string Example:02-getting-started
 * @bodyParam data.attributes.type string  Example:course
 * @bodyParam data.attributes.status string  Example:draft
 * @bodyParam data.attributes.language string Example:en-EN
 * @bodyParam data.attributes.sort integer Example:1
 * @bodyParam data.attributes.published_on datetime Example:2019-05-21 21:20:10
 * @bodyParam data.attributes.archived_on datetime Example:2019-05-31 21:20:10
 * @bodyParam data.attributes.fields array
 * @bodyParam data.attributes.brand string Example:brand
 * @bodyParam data.relationships.user.data.type string   Must be 'user'. Example:user
 * @bodyParam data.relationships.user.data.id integer   Must exists in user. Example:1
 */
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
                'data.type' => 'required|in:content',
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
                    'data.attributes.published_on',
                    'data.attributes.fields',
                    'data.relationships.user'
                ]
            );
    }
}
