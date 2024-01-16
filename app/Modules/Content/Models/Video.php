<?php

namespace App\Modules\Content\Models;

use App\Modules\Content\database\factories\InstructorFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;

/**
 * App\Modules\Content\Models\Video
 *
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\Content\Models\ContentField[] $fields
 * @mixin \Eloquent
 * @property-read int|null $data_count
 * @property-read int|null $fields_count
 */
class Video extends Content
{
    use HasFactory;

    private $fieldTypes = [
        'length_in_seconds' => 'string',
        'vimeo_video_id' => 'string',
        'youtube_video_id' => 'string',
    ];

    public function __construct()
    {
        parent::__construct([]);
        $this->language = 'en-US';
        $this->created_on = Carbon::now();
    }

    public function fields()
    {
        return $this->hasMany(ContentField::class, 'content_id');
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

    public function setLengthInSeconds($value)
    {
        $this->setField('length_in_seconds', $value);
    }

    public function setVimeoVideoId($value)
    {
        $this->setField('vimeo_video_id', $value);
    }

    public function setYoutubeVideoId($value)
    {
        $this->setField('youtube_video_id', $value);
    }
}
