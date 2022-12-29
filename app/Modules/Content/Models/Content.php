<?php

namespace App\Modules\Content\Models;

use App\Modules\Content\Builders\ContentBuilder;
use App\Modules\Content\database\factories\ContentFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Content\Models\Content
 *
 * @property integer $id
 * @property string $slug
 * @property string $type
 * @property integer $sort
 * @property string $status
 * @property string $brand
 * @property string $language
 * @property integer $user_id
 * @property string $album
 * @property string $artist
 * @property integer $associated_user_id
 * @property string $avatar_url
 * @property string $bands
 * @property string $cd_tracks
 * @property string $chord_or_scale
 * @property string $difficulty
 * @property string $difficulty_range
 * @property string $endorsements
 * @property integer $episode_number
 * @property string $exercise_book_pages
 * @property integer $fast_bpm
 * @property integer $forum_thread_id
 * @property string $high_soundslice_slug
 * @property integer $high_video
 * @property integer $home_staff_pick_rating
 * @property integer $includes_song
 * @property integer $is_active
 * @property integer $is_coach
 * @property integer $is_coach_of_the_month
 * @property integer $is_featured
 * @property integer $is_house_coach
 * @property integer $length_in_seconds
 * @property Carbon $live_event_start_time
 * @property Carbon $live_event_end_time
 * @property string $live_event_youtube_id
 * @property string $live_stream_feed_type
 * @property string $low_soundslice_slug
 * @property integer $low_video
 * @property string $name
 * @property integer $original_video
 * @property string $pdf
 * @property string $pdf_in_g
 * @property string $qna_video
 * @property integer $show_in_new_feed
 * @property string $slow_bpm
 * @property string $song_name
 * @property string $soundslice_slug
 * @property string $soundslice_xml_file_url
 * @property integer $staff_pick_rating
 * @property integer $student_id
 * @property string $title
 * @property string $transcriber_name
 * @property string $video
 * @property string $vimeo_video_id
 * @property string $youtube_video_id
 * @property integer $xp
 * @property integer $week
 * @property string $released
 * @property string $total_xp
 * @property integer $popularity
 * @property string $web_url_path
 * @property string $mobile_app_url_path
 * @property integer $child_count
 * @property integer $hierarchy_position_number
 * @property string $parent_content_data
 * @property string $compiled_view_data
 * @property string $instrument
 * @property integer $like_count
 * @property Carbon $published_on
 * @property Carbon $created_on
 * @property Carbon $archived_on
 * @method static ContentBuilder query()
 * @property int|null $instrumentless
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\Content\Models\ContentData[] $data
 * @property-read int|null $data_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\Content\Models\ContentField[] $fields
 * @property-read int|null $fields_count
 * @method static \App\Modules\Content\database\factories\ContentFactory factory(...$parameters)
 * @method static ContentBuilder|Content newModelQuery()
 * @method static ContentBuilder|Content newQuery()
 * @method static ContentBuilder|Content whereAlbum($value)
 * @method static ContentBuilder|Content whereArchivedOn($value)
 * @method static ContentBuilder|Content whereArtist($value)
 * @method static ContentBuilder|Content whereAssociatedUserId($value)
 * @method static ContentBuilder|Content whereAvatarUrl($value)
 * @method static ContentBuilder|Content whereBands($value)
 * @method static ContentBuilder|Content whereBrand($value)
 * @method static ContentBuilder|Content whereCdTracks($value)
 * @method static ContentBuilder|Content whereChildCount($value)
 * @method static ContentBuilder|Content whereChordOrScale($value)
 * @method static ContentBuilder|Content whereCompiledViewData($value)
 * @method static ContentBuilder|Content whereCreatedOn($value)
 * @method static ContentBuilder|Content whereDifficulty($value)
 * @method static ContentBuilder|Content whereDifficultyRange($value)
 * @method static ContentBuilder|Content whereEndorsements($value)
 * @method static ContentBuilder|Content whereEpisodeNumber($value)
 * @method static ContentBuilder|Content whereExerciseBookPages($value)
 * @method static ContentBuilder|Content whereFastBpm($value)
 * @method static ContentBuilder|Content whereForumThreadId($value)
 * @method static ContentBuilder|Content whereHierarchyPositionNumber($value)
 * @method static ContentBuilder|Content whereHighSoundsliceSlug($value)
 * @method static ContentBuilder|Content whereHighVideo($value)
 * @method static ContentBuilder|Content whereHomeStaffPickRating($value)
 * @method static ContentBuilder|Content whereId($value)
 * @method static ContentBuilder|Content whereIncludesSong($value)
 * @method static ContentBuilder|Content whereInstrument($value)
 * @method static ContentBuilder|Content whereInstrumentless($value)
 * @method static ContentBuilder|Content whereIsActive($value)
 * @method static ContentBuilder|Content whereIsCoach($value)
 * @method static ContentBuilder|Content whereIsCoachOfTheMonth($value)
 * @method static ContentBuilder|Content whereIsFeatured($value)
 * @method static ContentBuilder|Content whereIsHouseCoach($value)
 * @method static ContentBuilder|Content whereLanguage($value)
 * @method static ContentBuilder|Content whereLengthInSeconds($value)
 * @method static ContentBuilder|Content whereLikeCount($value)
 * @method static ContentBuilder|Content whereLiveEventEndTime($value)
 * @method static ContentBuilder|Content whereLiveEventStartTime($value)
 * @method static ContentBuilder|Content whereLiveEventYoutubeId($value)
 * @method static ContentBuilder|Content whereLiveStreamFeedType($value)
 * @method static ContentBuilder|Content whereLowSoundsliceSlug($value)
 * @method static ContentBuilder|Content whereLowVideo($value)
 * @method static ContentBuilder|Content whereMobileAppUrlPath($value)
 * @method static ContentBuilder|Content whereName($value)
 * @method static ContentBuilder|Content whereNotFuture()
 * @method static ContentBuilder|Content whereOriginalVideo($value)
 * @method static ContentBuilder|Content whereParentContentData($value)
 * @method static ContentBuilder|Content wherePdf($value)
 * @method static ContentBuilder|Content wherePdfInG($value)
 * @method static ContentBuilder|Content wherePopularity($value)
 * @method static ContentBuilder|Content wherePublishedOn($value)
 * @method static ContentBuilder|Content whereQnaVideo($value)
 * @method static ContentBuilder|Content whereReleased($value)
 * @method static ContentBuilder|Content whereShowInNewFeed($value)
 * @method static ContentBuilder|Content whereSlowBpm($value)
 * @method static ContentBuilder|Content whereSlug($value)
 * @method static ContentBuilder|Content whereSongName($value)
 * @method static ContentBuilder|Content whereSort($value)
 * @method static ContentBuilder|Content whereSoundsliceSlug($value)
 * @method static ContentBuilder|Content whereSoundsliceXmlFileUrl($value)
 * @method static ContentBuilder|Content whereStaffPickRating($value)
 * @method static ContentBuilder|Content whereStatus($value)
 * @method static ContentBuilder|Content whereStatuses(array $statuses)
 * @method static ContentBuilder|Content whereStudentId($value)
 * @method static ContentBuilder|Content whereTitle($value)
 * @method static ContentBuilder|Content whereTotalXp($value)
 * @method static ContentBuilder|Content whereTranscriberName($value)
 * @method static ContentBuilder|Content whereType($value)
 * @method static ContentBuilder|Content whereTypes(array $types)
 * @method static ContentBuilder|Content whereUserId($value)
 * @method static ContentBuilder|Content whereVideo($value)
 * @method static ContentBuilder|Content whereVimeoVideoId($value)
 * @method static ContentBuilder|Content whereWebUrlPath($value)
 * @method static ContentBuilder|Content whereWeek($value)
 * @method static ContentBuilder|Content whereXp($value)
 * @method static ContentBuilder|Content whereYoutubeVideoId($value)
 * @mixin \Eloquent
 */
class Content extends Model
{
    use HasFactory;

    protected $table = 'railcontent_content';
    public $timestamps = false;

    public function newEloquentBuilder($query): ContentBuilder
    {
        return new ContentBuilder($query);
    }

    public function fields()
    {
        return $this->hasMany(ContentField::class, 'content_id');
    }

    public function data()
    {
        return $this->hasMany(ContentData::class, 'content_id');
    }

    protected static function newFactory()
    {
        return ContentFactory::new();
    }
}
