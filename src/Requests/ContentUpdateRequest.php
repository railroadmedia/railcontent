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

    /**
     * @return array
     */
    public function onlyAllowed()
    {
        return
            $this->only(
                [
                    'slug',
                    'type',
                    'sort',
                    'status',
                    'brand',
                    'language' ,
                    'published_on',
                    'is_coach',
                    'is_coach_of_the_month',
                    'is_featured',
                    'is_active',
                    'is_house_coach',
                    'difficulty',
                    'title',
                    'xp',
                    'total_xp',
                    'album',
                    'artist',
                    'song_name',
                    'chord_or_scale',
                    'difficulty_range',
                    'episode_number',
                    'name',
                    'bands',
                    'endorsements',
                    'forum_thread_id',
                    'associated_user_id',
                    'show_in_new_feed',
                    'bpm'
                ]
            );
    }
}
