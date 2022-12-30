<?php

namespace App\Modules\Content\Models;

use App\Modules\Content\database\factories\InstructorFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;

/**
 * App\Modules\Content\Models\Instructor
 *
 * @property Collection $fields
 * @property Collection $data
 * @property int $id
 * @property string $slug
 * @property string $type
 * @property int $sort
 * @property string $status
 * @property string $brand
 * @property string $language
 * @property int|null $user_id
 * @property string|null $album
 * @property string|null $artist
 * @property int|null $associated_user_id
 * @property string|null $avatar_url
 * @property string|null $bands
 * @property string|null $cd_tracks
 * @property string|null $chord_or_scale
 * @property string|null $difficulty
 * @property string|null $difficulty_range
 * @property string|null $endorsements
 * @property int|null $episode_number
 * @property string|null $exercise_book_pages
 * @property int|null $fast_bpm
 * @property int|null $forum_thread_id
 * @property string|null $high_soundslice_slug
 * @property int|null $high_video
 * @property int|null $home_staff_pick_rating
 * @property int|null $includes_song
 * @property int|null $is_active
 * @property int|null $is_coach
 * @property int|null $is_coach_of_the_month
 * @property int|null $is_featured
 * @property int|null $is_house_coach
 * @property int|null $length_in_seconds
 * @property string|null $live_event_start_time
 * @property string|null $live_event_end_time
 * @property string|null $live_event_youtube_id
 * @property string|null $live_stream_feed_type
 * @property string|null $low_soundslice_slug
 * @property int|null $low_video
 * @property string|null $name
 * @property int|null $original_video
 * @property string|null $pdf
 * @property string|null $pdf_in_g
 * @property string|null $qna_video
 * @property int|null $show_in_new_feed
 * @property string|null $slow_bpm
 * @property string|null $song_name
 * @property string|null $soundslice_slug
 * @property string|null $soundslice_xml_file_url
 * @property int|null $staff_pick_rating
 * @property int|null $student_id
 * @property string|null $title
 * @property string|null $transcriber_name
 * @property string|null $video
 * @property string|null $vimeo_video_id
 * @property string|null $youtube_video_id
 * @property int|null $xp
 * @property int|null $week
 * @property string|null $released
 * @property string|null $total_xp
 * @property int|null $popularity
 * @property string|null $web_url_path
 * @property string|null $mobile_app_url_path
 * @property int|null $child_count
 * @property int|null $hierarchy_position_number
 * @property mixed|null $parent_content_data
 * @property mixed|null $compiled_view_data
 * @property string|null $instrument
 * @property int|null $instrumentless
 * @property int|null $like_count
 * @property string|null $published_on
 * @property string $created_on
 * @property string|null $archived_on
 * @method static \App\Modules\Content\database\factories\InstructorFactory factory(...$parameters)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor newModelQuery()
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor newQuery()
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor query()
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereAlbum($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereArchivedOn($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereArtist($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereAssociatedUserId($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereAvatarUrl($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereBands($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereBrand($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereCdTracks($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereChildCount($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereChordOrScale($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereCompiledViewData($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereCreatedOn($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereDifficulty($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereDifficultyRange($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereEndorsements($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereEpisodeNumber($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereExerciseBookPages($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereFastBpm($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereForumThreadId($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereHierarchyPositionNumber($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereHighSoundsliceSlug($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereHighVideo($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereHomeStaffPickRating($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereId($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereIncludesSong($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereInstrument($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereInstrumentless($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereIsActive($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereIsCoach($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereIsCoachOfTheMonth($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereIsFeatured($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereIsHouseCoach($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereLanguage($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereLengthInSeconds($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereLikeCount($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereLiveEventEndTime($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereLiveEventStartTime($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereLiveEventYoutubeId($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereLiveStreamFeedType($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereLowSoundsliceSlug($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereLowVideo($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereMobileAppUrlPath($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereName($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereNotFuture()
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereOriginalVideo($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereParentContentData($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor wherePdf($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor wherePdfInG($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor wherePopularity($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor wherePublishedOn($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereQnaVideo($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereReleased($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereShowInNewFeed($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereSlowBpm($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereSlug($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereSongName($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereSort($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereSoundsliceSlug($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereSoundsliceXmlFileUrl($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereStaffPickRating($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereStatus($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereStatuses(array $statuses)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereStudentId($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereTitle($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereTotalXp($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereTranscriberName($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereType($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereTypes(array $types)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereUserId($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereVideo($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereVimeoVideoId($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereWebUrlPath($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereWeek($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereXp($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|Instructor whereYoutubeVideoId($value)
 * @mixin \Eloquent
 * @property-read int|null $data_count
 * @property-read int|null $fields_count
 */
class Instructor extends Content
{
    use HasFactory;

    private $fieldTypes = [
        'is_coach' => 'boolean',
        'is_coach_of_the_month' => 'boolean',
        'is_house_coach' => 'boolean',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'tag' => 'string',
        'style' => 'string',
        'focus' => 'string',
        'endorsements' => 'string',
        'forum_thread_id' => 'string',
        'bands' => 'string',
        'name' => 'string'
    ];

    public function __construct()
    {
        parent::__construct([]);
        $this->type = 'instructor';
        $this->language = 'en-US';
        $this->created_on = Carbon::now();
    }

    protected static function newFactory(): InstructorFactory
    {
        return InstructorFactory::new();
    }

    private function setField(string $key, $value): void
    {
        /** @var ContentField $field */
        $field = $this->fields->where('key', '=', $key)->first();
        if (!$value) {
            if ($field) {
                Log::debug("Content Field ($this->id) $key $field->value deleted");
                $field->delete();
            }
            return;
        }
        if (!$field) {
            $field = $this->getNewContentField($key);
            Log::debug("Content Field ($this->id) $key inserted $value");
            $field->value = $value;
            $field->save();
            return;
        }
        if ($field->value != $value) {
            Log::debug("Content Field ($this->id) $key updated from '$field->value' to '$value'");
            $field->value = $value;
            $field->save();
        }
    }

    public function setFieldArray(string $key, array $values): void
    {
        $fields = $this->fields->where('key', '=', $key)->collect();
        $position = 1;
        foreach ($values as $value) {
            if (!$value) {
                continue;
            }
            $field = $fields->where('value', '=', $value)->first();
            if (!$field) {
                $field = $this->getNewContentField($key);
                Log::debug("Content Field ($this->id) $key inserted '$value'");
                $field->value = $value;
            }
            $field->position = $position;
            $field->save();
            $position++;
        }

        /** @var ContentField $field */
        foreach ($fields as $field) {
            if (!in_array($field->value, $values)) {
                Log::debug("Content Field ($this->id) $key $field->value deleted");
                $field->delete();
            }
        }
    }

    public function getNewContentField(string $key): ContentField
    {
        $field = new ContentField();
        $field->content_id = $this->id;
        $field->key = $key;
        $field->type = $this->fieldTypes[$key];
        return $field;
    }

    private function setData(string $key, $value)
    {
        /** @var ContentData $data */
        $data = $this->data->where('key', '=', $key)->first();
        if (!$value) {
            if ($data) {
                Log::debug("Content Data ($this->id) $key $data->value deleted");
                $data->delete();
            }
            return;
        }
        if (!$data) {
            $data = $this->getNewContentData($key);
            Log::debug("Content Data ($this->id) $key inserted $value");
            $data->value = $value;
            $data->save();
            return;
        }
        if ($data->value != $value) {
            Log::debug("Content Data ($this->id) $key updated from '$data->value' to '$value'");
            $data->value = $value;
            $data->save();
        }
    }


    public function getNewContentData(string $key): ContentData
    {
        $content = new ContentData();
        $content->content_id = $this->id;
        $content->key = $key;
        return $content;
    }

    public function setName($value)
    {
        $this->setField('name', $value);
        $this->name = $value;
    }


    public function setIsCoach($value)
    {
        $valueAsBool = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        $this->setField('is_coach', $valueAsBool);
        $this->is_coach = $valueAsBool ? 1 : 0;
    }

    public function setIsCoachOfTheMonth($value)
    {
        $valueAsBool = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        $this->setField('is_coach_of_the_month', $valueAsBool);
        $this->is_coach_of_the_month = $valueAsBool ? 1 : 0;
    }

    public function setIsHouseCoach($value)
    {
        $valueAsBool = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        $this->setField('is_house_coach', $valueAsBool);
        $this->is_house_coach = $valueAsBool ? 1 : 0;
    }

    public function setIsActive($value)
    {
        $valueAsBool = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        $this->setField('is_active', $valueAsBool);
        $this->is_active = $valueAsBool ? 1 : 0;
    }

    public function setIsFeatured($value)
    {
        $valueAsBool = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        $this->setField('is_featured', $valueAsBool);
        $this->is_featured = $valueAsBool ? 1 : 0;
    }

    public function setFocusTags($value)
    {
        $values = array_map('trim', explode(',', $value));
        $this->setFieldArray('focus', $values);
    }

    public function setStyleTags($value)
    {
        $values = array_map('trim', explode(',', $value));
        $this->setFieldArray('style', $values);
    }

    public function setCardShortDescription($value)
    {
        $this->setData('focus_text', $value);
    }

    public function setShortBio($value)
    {
        $this->setData('short_bio', $value);
    }

    public function setLongBio($value)
    {
        $this->setData('long_bio', $value);
    }

    public function setBands($value)
    {
        $this->setField('bands', $value);
        $this->bands = null;
    }


    public function setForumThreadId($value)
    {
        $this->setField('forum_thread_id', $value);
    }

    public function setEndorsements($value)
    {
        $this->setField('endorsements', $value);
    }

    public function setFacebook($value)
    {
        $this->setData('link_facebook', $value);
    }

    public function setInstagram($value)
    {
        $this->setData('link_instagram', $value);
    }

    public function setTwitter($value)
    {
        $this->setData('link_twitter', $value);
    }

    public function setTiktok($value)
    {
        $this->setData('link_tiktok', $value);
    }

    public function setYouTube($value)
    {
        $this->setData('link_youtube', $value);
    }

    public function setCardImage($value)
    {
        $this->setData('coach_card_image', $value);
    }

    public function setBottomBannerImage($value)
    {
        $this->setData('coach_bottom_banner_image', $value);
    }

    public function setTopBannerImage($value)
    {
        $this->setData('coach_top_banner_image', $value);
    }

    public function setFeaturedImage($value)
    {
        $this->setData('coach_featured_image', $value);
    }

}
