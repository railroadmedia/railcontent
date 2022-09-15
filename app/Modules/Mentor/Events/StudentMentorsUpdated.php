<?php

namespace App\Modules\Mentor\Events;

use App\Modules\Mentor\Models\MentorStudent;
use Illuminate\Support\Collection;

class StudentMentorsUpdated
{
    public array $mentorStudentData;


    private function __construct(array $mentorStudentData)
    {
        $this->mentorStudentData = $mentorStudentData;
    }

    public static function newWithMentorStudent(MentorStudent $mentorStudent): StudentMentorsUpdated
    {
        return self::newWithMentorStudentCollection(collect([$mentorStudent]));
    }

    public static function newWithMentorStudentCollection(Collection $mentorStudents): StudentMentorsUpdated
    {
        $data = $mentorStudents->map(function ($mentorStudent) {
            return [
                'userId' => $mentorStudent->user_id,
                'mentorUserId' => $mentorStudent->mentor_user_id,
                'primaryBrand' => $mentorStudent->primary_brand,
            ];
        })->toArray();
        return new StudentMentorsUpdated($data);
    }

}
