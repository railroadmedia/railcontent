<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService as ContentService;

class ContentCreateRequest extends FormRequest
{
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'data.type' => 'json data type',
            'data.attributes.slug' => 'slug',
            'data.attributes.type' => 'type',
            'data.attributes.sort' => 'sort',
            'data.attributes.status' => 'status',
            'data.attributes.brand' => 'brand',
            'data.attributes.language' => 'language',

            'data.attributes.user_id' => 'user id',
            'data.attributes.difficulty' => 'difficulty',
            'data.attributes.home_staff_pick_rating' => 'home staff pick rating',
            'data.attributes.legacy_id' => 'legacy id',
            'data.attributes.legacy_wordpress_post_is' => 'legacy wordpress post id',
            'data.attributes.qna_video' => 'qna video',
            'data.attributes.style' => 'style',
            'data.attributes.title' => 'title',
            'data.attributes.video' => 'video',
            'data.attributes.bpm' => 'bpm',
            'data.attributes.cd_tracks' => 'cd tracks',
            'data.attributes.chord_or_scale' => 'chord or scale',
            'data.attributes.difficulty_range' => 'difficulty range',
            'data.attributes.episode_number' => 'episode number',
            'data.attributes.exercise_book_page' => 'exercise book page',
            'data.attributes.fast_bpm' => 'fast bpm',
            'data.attributes.includes_song' => 'include song',
            'data.attributes.instructors' => 'instructors',
            'data.attributes.live_event_start_time' => 'live event start time',
            'data.attributes.live_event_end_time' => 'live event end time',
            'data.attributes.live_event_youtube_id' => 'live event youtube id',
            'data.attributes.live_stream_feed_type' => 'live stream feed type',
            'data.attributes.name' => 'name',
            'data.attributes.released' => 'released',
            'data.attributes.slow_bpm' => 'slow bpm',
            'data.attributes.total_xp' => 'total xp',

            'data.attributes.transcriber_name' => 'transcriber name',
            'data.attributes.week' => 'week',
            'data.attributes.xp' => 'xp',
            'data.attributes.album' => 'album',
            'data.attributes.artist' => 'artist',
            'data.attributes.published_on' => 'published on',
            'data.attributes.created_on' => 'created on',
            'data.attributes.archived_on' => 'archived on',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
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
//                'parent_id' => 'nullable|numeric|exists:' . ConfigService::$databaseConnectionName . '.' .
//                    ConfigService::$tableContent . ',id',
                'data.attributes.published_on' => 'nullable|date'
//            'data.type' => 'in:address',
//            'data.attributes.type' => 'required|max:255|in:' . implode(
//                    ',',
//                    [
//                        ConfigService::$billingAddressType,
//                        ConfigService::$shippingAddressType,
//                    ]
//                ),
//            'data.attributes.first_name' => 'nullable|max:255',
//            'data.attributes.last_name' => 'nullable|max:255',
//            'data.attributes.street_line_1' => 'nullable|max:255',
//            'data.attributes.street_line_2' => 'nullable|max:255',
//            'data.attributes.city' => 'nullable|max:255',
//            'data.attributes.zip' => 'nullable|max:255',
//            'data.attributes.state' => 'nullable|max:255',
//            'data.attributes.country' => 'required|max:255|in:' . implode(',', LocationService::countries()),
            // todo: use proper json API spec structure for changing relationships
            //            'data.attributes.user_id' => 'integer|nullable',
            //            'data.attributes.customer_id' => 'integer|nullable|exists:' . ConfigService::$tableCustomer . ',id',
        ];
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
                    'data.attributes.difficulty',
                    'data.attributes.home_staff_pick_rating',
                    'data.attributes.legacy_id',
                    'data.attributes.legacy_wordpress_post_is',
                    'data.attributes.qna_video',
                    'data.attributes.style',
                    'data.attributes.title',
                    'data.attributes.video',
                    'data.attributes.bpm',
                    'data.attributes.cd_tracks',
                    'data.attributes.chord_or_scale' ,
                    'data.attributes.difficulty_range' ,
                    'data.attributes.episode_number',
                    'data.attributes.exercise_book_page',
                    'data.attributes.fast_bpm',
                    'data.attributes.includes_song',
                    'data.attributes.instructors',
                    'data.attributes.live_event_start_time' ,
                    'data.attributes.live_event_end_time',
                    'data.attributes.live_event_youtube_id' ,
                    'data.attributes.live_stream_feed_type',
                    'data.attributes.name' ,
                    'data.attributes.released' ,
                    'data.attributes.slow_bpm',
                    'data.attributes.total_xp',

                    'data.attributes.transcriber_name',
                    'data.attributes.week' ,
                    'data.attributes.xp',
                    'data.attributes.album',
                    'data.attributes.artist' ,
                    'data.attributes.published_on' ,
                    'data.attributes.created_on' ,
                    'data.attributes.archived_on' ,
//                    'data.attributes.type',
//                    // todo: use proper json API spec structure for changing relationships
//                    //                    'data.attributes.user_id',
//                    //                    'data.attributes.customer_id',
//                    'data.attributes.first_name',
//                    'data.attributes.last_name',
//                    'data.attributes.street_line_1',
//                    'data.attributes.street_line_2',
//                    'data.attributes.city',
//                    'data.attributes.zip',
//                    'data.attributes.state',
//                    'data.attributes.country',
//                    'data.relationships.user',
//                    'data.relationships.customer',
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
