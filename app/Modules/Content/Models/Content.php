<?php

namespace App\Modules\Content\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Modules\Content\Builders\ContentBuilder;
use App\Modules\Content\database\factories\ContentFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Log;
use Modules\Content\Models\ContentCreativity;
use Modules\Content\Models\ContentEssentials;
use Modules\Content\Models\ContentGears;
use Modules\Content\Models\ContentLifestyle;
use Modules\Content\Models\ContentTheory;
use Modules\Content\Models\ContentTopic;
use Railroad\Railcontent\Helpers\ContentHelper;

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
 * @property Carbon $enrollment_start_time
 * @property Carbon $enrollment_end_time
 * @property string $registration_url
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
 * @property integer $instructor
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

    private $fieldTypes = [
        'topic' => 'string',
        'style' => 'string',
        'focus' => 'string',
        'difficulty' => 'string',
        'title' => 'string',
        'instructor' => 'content_id',
        'video' => 'content_id',
        'xp' => 'integer',
        'registration_url' => 'string',
        'enrollment_start_time' => 'datetime',
        'enrollment_end_time' => 'datetime',
        'soundslice_slug' => 'string',
        'total_xp' => 'integer',
        'essentials' => 'string',
        'theory' => 'string',
        'creativity' => 'string',
        'lifestyle' => 'string',
        'gear' => 'string',
        'genre' => 'string',
        'released' => 'string',
        'length_in_seconds' => 'integer',
        'album' => 'string',

    ];

    public function newEloquentBuilder($query): ContentBuilder
    {
        return new ContentBuilder($query);
    }

    public function fields(): HasMany
    {
        return $this->hasMany(ContentField::class, 'content_id');
    }

    public function data(): HasMany
    {
        return $this->hasMany(ContentData::class, 'content_id');
    }

    protected static function newFactory()
    {
        return ContentFactory::new();
    }

    private function setField(string $key, $value): void
    {
        /** @var ContentField $field */
        $field =
            $this->fields->where('key', '=', $key)
                ->first();

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
        $fields =
            $this->fields->where('key', '=', $key)
                ->collect();
        $position = 1;
        foreach ($values as $value) {
            if (!$value) {
                continue;
            }
            $field =
                $fields->where('value', '=', $value)
                    ->first();
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
        $field->position = 1;

        return $field;
    }

    private function setData(string $key, $value)
    {
        /** @var ContentData $data */
        $data =
            $this->data->where('key', '=', $key)
                ->first();
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
        $content->position = 1;

        return $content;
    }

    public function setTopic($value)
    {
        if ($value && $value != 'NULL') {
            $topic =
                ContentTopic::query()
                    ->where('content_id', '=', $this->id)
                    ->where('topic', $value)
                    ->first();
            if (!$topic) {
                $topic = new ContentTopic();
                $topic->content_id = $this->id;
                $topic->topic = $value;
                $topic->position = 1;
                $topic->save();
            }
            $this->createField('topic', $value);
        }
    }

    public function setTitle($value)
    {
        $this->setField('title', $value);
        $this->title = $value;
    }

    public function setDifficulty($value)
    {
        $this->setField('difficulty', $value);
        $this->difficulty = $value;
    }

    public function setXP($value)
    {
        if ($value) {
            $this->setField('xp', $value);
            $this->xp = $value;
        }
    }

    public function setTotalXP($value)
    {
        if ($value) {
            $this->setField('total_xp', $value);
            $this->total_xp = $value;
        }
    }

    public function setRegistrationUrl($value)
    {
        if ($value && $value != 'NULL') {
            $this->setField('registration_url', $value);
        }
    }

    public function setEnrollmentStartDate($value)
    {
        if ($value && $value != 'NULL') {
            $this->setField('enrollment_start_time', $value);
        }
    }

    public function setEnrollmentEndDate($value)
    {
        if ($value && $value != 'NULL') {
            $this->setField('enrollment_end_time', $value);
        }
    }

    public function setInstructor($value)
    {
        if ($value && $value != 'NULL') {
            $instructor =
                Instructor::query()
                    ->where('name', 'like', '%'.$value.'%')
                    ->first();
            if ($instructor) {
                $contentInstructor =
                    ContentInstructor::query()
                        ->where('content_id', '=', $this->id)
                        ->where('instructor_id', $instructor->id)
                        ->get();
                if ($contentInstructor->count() == 0) {
                    $this->setField('instructor', $instructor->id);
                }
            } else {
                Log::debug("Instructor not exist::: ($value) ");
            }
        }
    }

    public function setDescription($value)
    {
        if ($value && $value != 'NULL') {
            $this->setData('description', $value);
        }
    }

    public function setOriginalThumb($value)
    {
        if ($value && $value != 'NULL') {
            $this->setData('original_thumbnail_url', $value);
        }
    }

    public function setThumb($value)
    {
        if ($value && $value != 'NULL') {
            $this->setData('thumbnail_url', $value);
        }
    }

    public function setLogo($value)
    {
        if ($value && $value != 'NULL') {
            $this->setData('logo_image_url', $value);
        }
    }

    public function setHeaderImage($value)
    {
        if ($value && $value != 'NULL') {
            $this->setData('header_image_url', $value);
        }
    }

    public function setSoundsliceSlug($value)
    {
        if ($value && $value != 'NULL') {
            $this->setField('soundslice_slug', $value);
        }
    }

    public function setVideo($value, $duration = '', $type = 'vimeo')
    {
        if (!$value) {
            return;
        }
        $video =
            Content::query()
                ->where($type.'_video_id', '=', $value)
                //->orWhere('slug', '=', $type.'-video-'.$value)
                ->first();
        if (!$video) {
            $video = new Video();
            $video->type = $type.'-video';
            $video->status = 'published';
            $video->brand = $this->brand;
            $video->slug = $type.'-video-'.$value;
            $typeId = $type.'_video_id';
            if ($type == 'vimeo') {
                $video->vimeo_video_id = $value;
            } else {
                $video->youtube_video_id = $value;
            }
            $video->length_in_seconds = $duration;

            $video->published_on =
                Carbon::now()
                    ->toDateTimeString();
            $video->save();
            $video->setLengthInSeconds($duration);
            if ($type == 'vimeo') {
                $video->setVimeoVideoId($value);
            } else {
                $video->setYoutubeVideoId($value);
            }
        }

        $id = $video->id;

        $this->setField('video', $id);
    }

    public function setParentId($value, $childPosition = 1)
    {
        $hierarhy =
            ContentHierarchy::query()
                ->where('parent_id', '=', $value)
                ->where('child_id', '=', $this->id)
                ->get();

        if ($hierarhy->isEmpty()) {
            $hierarhy = new ContentHierarchy();
            $hierarhy->parent_id = $value;
            $hierarhy->child_id = $this->id;
            $hierarhy->child_position = $childPosition;
            $hierarhy->created_on =
                Carbon::now()
                    ->toDateTimeString();
            $hierarhy->save();
        }
    }

    public function setStyle($value)
    {
        if ($value) {
            $style =
                ContentStyle::query()
                    ->where('content_id', '=', $this->id)
                    ->where('style', $value)
                    ->first();
            if (!$style) {
                $style = new ContentStyle();
                $style->content_id = $this->id;
                $style->style = $value;
                $style->position = 1;
                $style->save();
            }
            $this->createField('style', $value);
        }
    }

    public function setChapter($value, $position = 1, $thumb = null)
    {
        if (!$value) {
            return;
        }
        $chapterData = explode(':', $value);
        $chapterDescription =
            $this->data->where('key', '=', 'chapter_description')
                ->where('position', '=', $position)
                ->first();
        if ($chapterDescription) {
            $chapterDescription->delete();
        }
        $data = $this->getNewContentData('chapter_description');
        $data->position = $position;
        $data->value = $chapterData[0];
        $data->save();

        $chapterTimecode =
            $this->data->where('key', '=', 'chapter_timecode')
                ->where('position', '=', $position)
                ->first();

        if ($chapterTimecode) {
            $chapterTimecode->delete();
        }

        $dataTimecode = $this->getNewContentData('chapter_timecode');
        $dataTimecode->position = $position;
        $dataTimecode->value = $chapterData[1];
        $dataTimecode->save();

        if ($thumb) {
            // dd($thumb);
            $chapterThumb =
                $this->data->where('key', '=', 'chapter_thumbnail_url')
                    ->where('position', '=', $position)
                    ->first();
            if ($chapterThumb) {
                $chapterThumb->delete();
            }
            $dataThumb = $this->getNewContentData('chapter_thumbnail_url');
            $dataThumb->position = $position;
            $dataThumb->value = $thumb;
            $dataThumb->save();
        }
    }

    public function setPermissions($values)
    {
        foreach ($values as $value) {
            $permission =
                ContentPermissions::query()
                    ->where('content_id', '=', $this->id)
                    ->where('permission_id', '=', $value)
                    ->where('brand', '=', $this->brand)
                    ->first();
            if (!$permission) {
                $permission = new ContentPermissions();
                $permission->content_id = $this->id;
                $permission->permission_id = $value;
                $permission->brand = $this->brand;
                $permission->save();
            }
        }
    }

    public function setEssentials($value, $position = 1)
    {
        if ($value) {
            $essential =
                ContentEssentials::query()
                    ->where('content_id', '=', $this->id)
                    ->where('essentials', $value)
                    ->first();
            if (!$essential) {
                $essential = new ContentEssentials();
                $essential->content_id = $this->id;
                $essential->essentials = $value;
                $essential->position = $position;
                $essential->save();
            }
            $this->createField('essentials', $value);
        }
    }

    public function setTheory($value, $position = 1)
    {
        if ($value) {
            $theory =
                ContentTheory::query()
                    ->where('content_id', '=', $this->id)
                    ->where('theory', $value)
                    ->first();
            if (!$theory) {
                $theory = new ContentTheory();
                $theory->content_id = $this->id;
                $theory->theory = $value;
                $theory->position = $position;
                $theory->save();
            }
            $this->createField('theory', $value);
        }
    }

    public function setCreativity($value, $position = 1)
    {
        if ($value) {
            $creativity =
                ContentCreativity::query()
                    ->where('content_id', '=', $this->id)
                    ->where('creativity', $value)
                    ->first();
            if (!$creativity) {
                $creativity = new ContentCreativity();
                $creativity->content_id = $this->id;
                $creativity->creativity = $value;
                $creativity->position = $position;
                $creativity->save();
            }
            $this->createField('creativity', $value);
        }
    }

    public function setLifestyle($value, $position = 1)
    {
        if ($value) {
            $lifestyle =
                ContentLifestyle::query()
                    ->where('content_id', '=', $this->id)
                    ->where('lifestyle', $value)
                    ->first();
            if (!$lifestyle) {
                $lifestyle = new ContentLifestyle();
                $lifestyle->content_id = $this->id;
                $lifestyle->lifestyle = $value;
                $lifestyle->position = $position;
                $lifestyle->save();
            }

            $this->createField('lifestyle', $value);
        }
    }

    public function setGear($value)
    {
        if ($value) {
            $gear =
                ContentGears::query()
                    ->where('content_id', '=', $this->id)
                    ->where('gear', $value)
                    ->first();
            if (!$gear) {
                $gear = new ContentGears();
                $gear->content_id = $this->id;
                $gear->gear = $value;
                $gear->position = 1;
                $gear->save();
            }
            $this->createField('gear', $value);
        }
    }

    public function setReleased($value)
    {
        $this->setField('released', $value);
        $this->released = $value;
    }

    public function deleteFields(string $key): void
    {
        $fields =
            $this->fields->where('key', '=', $key)
                ->collect();

        /** @var ContentField $field */
        foreach ($fields as $field) {
            Log::debug("Content Field ($this->id) $key $field->value deleted");
            $field->delete();
        }
    }

    private function createField(string $key, $value): void
    {
        /** @var ContentField $field */
        $field = $this->getNewContentField($key);

        Log::debug("Content Field ($this->id) $key inserted $value");
        $field->value = $value;
        $field->save();
    }

    public function contentHierarchy(): HasOne
    {
        return $this->hasOne(ContentHierarchy::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(ContentHierarchy::class, 'parent_id');
    }

    public function setLengthInSeconds($value)
    {
        if ($value) {
            $this->setField('length_in_seconds', $value);
        }
    }

    public function setAlbum($value)
    {
        if ($value) {
            $this->setField('album', $value);
        }
    }

    public function setAssignments($value)
    {
        if (is_array($value)) {
            foreach ($value as $index => $assignmentData) {
                if (isset($assignmentData['railcontent_id'])) {
                    $assignment = Content::where('id', '=', $assignmentData['railcontent_id'])->get();
                    if ($assignment->isEmpty()) {
                        $assignment = new Content();
                        $assignment->title = $assignmentData['assignment_title'];
                        $assignment->type = 'assignment';
                        $assignment->status = 'published';
                        $assignment->slug       = ContentHelper::slugify($assignmentData['assignment_title']);
                        $assignment->language   = 'en-US';
                        $assignment->created_on = Carbon::now()->toDateTimeString();
                        $assignment->brand      = $this->brand;
                        $assignment->soundslice_slug = $assignmentData['assignment_soundslice'];

                        $assignment->save();
                        $assignment->setDescription($assignmentData['assignment_description']);
                        $assignment->setParentId($this->id);
                    }
                } else {
                    $assignment = new Content();
                    $assignment->title = $assignmentData['assignment_title'];
                    $assignment->type = 'assignment';
                    $assignment->status = 'published';
                    $assignment->slug       = ContentHelper::slugify($assignmentData['assignment_title']);
                    $assignment->language   = 'en-US';
                    $assignment->created_on = Carbon::now()->toDateTimeString();
                    $assignment->brand      = $this->brand;
                    $assignment->soundslice_slug = $assignmentData['assignment_soundslice'];
                    $assignment->save();
                    $value[$index]['railcontent_id'] = $assignment->id;
                    $assignment->setParentId($this->id);
                    $assignment->setDescription($assignmentData['assignment_description']);
                }
            }
        }

        return $value;
    }

    public function setChildId($value, $childPosition = 1)
    {
        $hierarhy =
            ContentHierarchy::query()
                ->where('parent_id', '=', $this->id)
                ->where('child_id', '=', $value)
                ->get();

        if ($hierarhy->isEmpty()) {
            $hierarhy = new ContentHierarchy();
            $hierarhy->parent_id = $this->id;
            $hierarhy->child_id = $value;
            $hierarhy->child_position = $childPosition;
            $hierarhy->created_on =
                Carbon::now()
                    ->toDateTimeString();
            $hierarhy->save();
        }
    }

    public function setParentContentData($parent)
    {
        $parentContentData = [(object)[
            'id' => $parent['id'],
            'slug' => $parent['slug'],
            'type' => $parent['type'],
            'position' => null,
        ]];

        $this->parent_content_data = (json_encode($parentContentData));
        $this->save();
    }
}
