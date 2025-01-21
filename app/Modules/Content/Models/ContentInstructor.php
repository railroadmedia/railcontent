<?php

namespace App\Modules\Content\Models;

use App\Modules\Content\database\factories\ContentInstructorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factory;

/**
 * App\Modules\Content\Models\ContentInstructor
 *
 * @property integer $id
 * @property integer $content_id
 * @property integer $instructor_id
 * @property integer $position
 * @method static \App\Modules\Content\database\factories\ContentInstructorFactory factory(...$parameters)
 * @method static \App\Modules\Content\Builders\ContentBuilder|ContentInstructor newModelQuery()
 * @method static \App\Modules\Content\Builders\ContentBuilder|ContentInstructor newQuery()
 * @method static \App\Modules\Content\Builders\ContentBuilder|ContentInstructor query()
 * @method static \App\Modules\Content\Builders\ContentBuilder|ContentInstructor whereContentId($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|ContentInstructor whereId($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|ContentInstructor whereInstructorId($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|ContentInstructor whereNotFuture()
 * @method static \App\Modules\Content\Builders\ContentBuilder|ContentInstructor wherePosition($value)
 * @method static \App\Modules\Content\Builders\ContentBuilder|ContentInstructor whereStatuses(array $statuses)
 * @method static \App\Modules\Content\Builders\ContentBuilder|ContentInstructor whereTypes(array $types)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\Content\Models\ContentData[] $data
 * @property-read int|null $data_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\Content\Models\ContentField[] $fields
 * @property-read int|null $fields_count
 */
class ContentInstructor extends Content
{
    use HasFactory;

    protected $table = 'railcontent_content_instructors';
    public $timestamps = false;

    protected static function newFactory(): ContentInstructorFactory
    {
        return ContentInstructorFactory::new();
    }

    public function instructor()
    {
        return $this->belongsTo(Content::class, 'instructor_id');
    }
}
