<?php

namespace Railroad\Railcontent\Models;

use Illuminate\Database\Eloquent\Model;
use Iksaku\Laravel\MassUpdate\MassUpdatable;

/**
 * App\Models\Content
 *
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
 * @property int|null $like_count
 * @property string|null $published_on
 * @property string $created_on
 * @property string|null $archived_on
 * @method static \Illuminate\Database\Eloquent\Builder|Content newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Content newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Content query()
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereAlbum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereArchivedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereArtist($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereAssociatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereAvatarUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereBands($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereCdTracks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereChildCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereChordOrScale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereCreatedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereDifficulty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereDifficultyRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereEndorsements($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereEpisodeNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereExerciseBookPages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereFastBpm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereForumThreadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereHierarchyPositionNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereHighSoundsliceSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereHighVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereHomeStaffPickRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereIncludesSong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereIsCoach($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereIsCoachOfTheMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereIsHouseCoach($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereLengthInSeconds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereLikeCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereLiveEventEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereLiveEventStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereLiveEventYoutubeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereLiveStreamFeedType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereLowSoundsliceSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereLowVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereMobileAppUrlPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereOriginalVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereParentContentData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content wherePdf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content wherePdfInG($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content wherePopularity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content wherePublishedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereQnaVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereReleased($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereShowInNewFeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereSlowBpm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereSongName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereSoundsliceSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereSoundsliceXmlFileUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereStaffPickRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereTotalXp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereTranscriberName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereVimeoVideoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereWebUrlPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereXp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereYoutubeVideoId($value)
 * @mixin \Eloquent
 */
class Content extends Model
{
    use MassUpdatable;

    protected $table = 'railcontent_content';

    const CREATED_AT = 'created_on';
    const UPDATED_AT = null;

    /**
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->connection = config('railcontent.database_connection_name');

        parent::__construct($attributes);
    }
}
