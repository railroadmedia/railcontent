<?php

namespace App\Modules\Content\Models;

use App\Modules\Content\database\factories\ContentInstructorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factory;

/**
 * @property integer $id
 * @property integer $content_id
 * @property integer $instructor_id
 * @property integer $position
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
}
