<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService as ContentService;

class ContentCreateRequest extends CustomFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return  [
                'data.attributes.status' => 'max:64|required|in:' .
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
                'data.attributes.type' => 'required|max:64',
                'data.attributes.sort' => 'nullable|numeric',
                'data.attributes.position' => 'nullable|numeric|min:0',
                'data.attributes.published_on' => 'nullable|date'
                ];
       // $this->validateContent($this);

//        $this->setGeneralRules(
//            [
//                'data.attributes.status' => 'max:64|required|in:' .
//                    implode(
//                        ',',
//                        [
//                            ContentService::STATUS_DRAFT,
//                            ContentService::STATUS_PUBLISHED,
//                            ContentService::STATUS_ARCHIVED,
//                            ContentService::STATUS_SCHEDULED,
//                            ContentService::STATUS_DELETED,
//                        ]
//                    ),
//                'data.attributes.type' => 'required|max:64',
//                'data.attributes.sort' => 'nullable|numeric',
//                'data.attributes.position' => 'nullable|numeric|min:0',
//                'data.attributes.published_on' => 'nullable|date'
//                ]);
//
//        //set the custom validation rules based on content type and brand
//        $this->setCustomRules($this);

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

                    'data.attributes.user_id',
//                    'data.attributes.difficulty',
//                    'data.attributes.home_staff_pick_rating',
//                    'data.attributes.legacy_id',
//                    'data.attributes.legacy_wordpress_post_is',
//                    'data.attributes.qna_video',
//                    'data.attributes.style',
//                    'data.attributes.title',
//                    'data.attributes.video',
//                    'data.attributes.bpm',
//                    'data.attributes.cd_tracks',
//                    'data.attributes.chord_or_scale' ,
//                    'data.attributes.difficulty_range' ,
//                    'data.attributes.episode_number',
//                    'data.attributes.exercise_book_page',
//                    'data.attributes.fast_bpm',
//                    'data.attributes.includes_song',
//                    'data.attributes.instructors',
//                    'data.attributes.live_event_start_time' ,
//                    'data.attributes.live_event_end_time',
//                    'data.attributes.live_event_youtube_id' ,
//                    'data.attributes.live_stream_feed_type',
//                    'data.attributes.name' ,
//                    'data.attributes.released' ,
//                    'data.attributes.slow_bpm',
//                    'data.attributes.total_xp',
//
//                    'data.attributes.transcriber_name',
//                    'data.attributes.week' ,
//                    'data.attributes.xp',
//                    'data.attributes.album',
//                    'data.attributes.artist' ,
//                    'data.attributes.published_on' ,
//                    'data.attributes.created_on' ,
//                    'data.attributes.archived_on' ,

                    'data.attributes.fields',
                    'data.relationships.parent.data.id'
                ]

        );
    }
//    protected $generalRules;
//
//    /**
//     * Get the validation rules that apply to the request.
//     *
//     * @return array
//     */
//    public function rules()
//    {
//        $this->validateContent($this);
//
//        //set the general validation rules
//        $this->setGeneralRules(
//            [
//                'status' => 'max:64|in:' .
//                    implode(
//                        ',',
//                        [
//                            ContentService::STATUS_DRAFT,
//                            ContentService::STATUS_PUBLISHED,
//                            ContentService::STATUS_ARCHIVED,
//                            ContentService::STATUS_SCHEDULED,
//                            ContentService::STATUS_DELETED,
//                        ]
//                    ),
//                'type' => 'required|max:64',
//                'sort' => 'nullable|numeric',
//                'position' => 'nullable|numeric|min:0',
//                'parent_id' => 'nullable|numeric|exists:' . ConfigService::$databaseConnectionName . '.' .
//                    ConfigService::$tableContent . ',id',
//                'published_on' => 'nullable|date'
//            ]
//        );
//
//        //set the custom validation rules based on content type and brand
//        $this->setCustomRules($this);
//
//        //get the validation rules
//        return parent::rules();
//    }
//
//    protected function contentValidationRequired()
//    {
//        /*
//         * Can this be deleted? If the method this will override - CustomFormRequest::contentValidationRequired - needs
//         * to not run in this case, then at least a comment should be added here saying as much... lest this just get
//         * deleted and break something.
//         *
//         * Or maybe it *can* just be deleted - and not break anything?
//         *
//         * Jonathan, April 12
//         */
//    }
}
