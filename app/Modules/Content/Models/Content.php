<?php

namespace App\Modules\Content\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
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
 */
class Content extends Model
{
    protected $table = 'railcontent_content';
    public $timestamps = false;

}
