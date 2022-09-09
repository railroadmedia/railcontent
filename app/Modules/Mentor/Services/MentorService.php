<?php

namespace App\Modules\Mentor\Services;


use App\Modules\Brand\Services\PrimaryBrandService;
use App\Modules\Mentor\Events\StudentMentorsUpdated;
use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Models\MentorStudent;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Str;

class MentorService
{
    private PrimaryBrandService $primaryBrandService;
    private ?Collection $mentors = null;

    public function __construct(PrimaryBrandService $primaryBrandService)
    {
        $this->primaryBrandService = $primaryBrandService;
    }

    public function store(int $userId, string $supportedBrand, int $maxStudents = 5000): void
    {
        $mentor = new Mentor();
        $mentor->user_id = $userId;
        $mentor->supported_brands = $supportedBrand;
        $mentor->active_student_max_count = $maxStudents;
        $mentor->active_student_count = 0;
        $mentor->total_student_count = 0;
        $mentor->save();
    }

    public function assignMentor(int $userId): bool
    {
        $brand = $this->getPrimaryBrandForAssigningMentor($userId);
        if (!$brand) {
            Log::warning("Unable to choose a brand for user '$userId'");
            return false;
            //throw new Exception("Unable to choose a brand for user '$userId'");
        }
        return $this->assignMentorByBrand($userId, $brand);
    }

    public function assignMentorByBrand(int $userId, string $brand): bool
    {
        Log::info("Assigning Mentor to User $userId");
        $mentor = $this->chooseMentor($brand);
        if (!$mentor) {
            Log::warning("Unable to assign Mentor to User $userId");
            return false;
        }
        $mentorStudent = $this->getMentorStudentOrNull($userId);
        if (!$mentorStudent) {
            $mentorStudent = new MentorStudent();
            $mentorStudent->user_id = $userId;
        }
        $mentorStudent->primary_brand = $brand;
        $mentorStudent->mentor_user_id = $mentor->user_id;
        if ($mentorStudent->isActive()) {
            $mentor->active_student_count += 1;
        }
        $mentor->total_student_count += 1;
        $mentorStudent->save();
        $mentor->save();
        event(StudentMentorsUpdated::newWithMentorStudent($mentorStudent));
        return true;
    }

    private function chooseNewMentor(MentorStudent $mentorStudent): ?Mentor
    {
        $brand = $mentorStudent->primary_brand;
        if (!$brand) {
            $brand = $this->getPrimaryBrandForAssigningMentor($mentorStudent->user_id);
        }
        $mentor = $this->chooseMentor($brand);
        return $mentor;
    }


    public function ensureMentorState(User $user): EnsureMentorResult
    {
        $active = $user->isActiveStudent();
        $mentorStudent = $user->mentorStudent;
        if ($active && (!$mentorStudent || !$mentorStudent->mentor_user_id)) {
            if ($this->assignMentor($user->id)) {
                return EnsureMentorResult::MentorAssigned;
            }
        } elseif ($active && $mentorStudent && !$mentorStudent->isActive()) {
            $this->activateMentorStudent($mentorStudent);
            return EnsureMentorResult::ActiveStateUpdated;
        } elseif (!$active && $mentorStudent && $mentorStudent->isActive()) {
            $this->deactivateMentorStudent($mentorStudent);
            return EnsureMentorResult::ActiveStateUpdated;
        }
        return EnsureMentorResult::NoChange;
    }

    private function activateMentorStudent(?MentorStudent $mentorStudent): void
    {
        Log::info("Activating student $mentorStudent->user_id");
        $mentor = $this->getMentorOrNull($mentorStudent->mentor_user_id);
        $mentor->active_student_count++;
        $mentor->save();
    }

    private function deactivateMentorStudent(?MentorStudent $mentorStudent): void
    {
        Log::info("Deactivating student $mentorStudent->user_id");
        $mentor = $this->getMentorOrNull($mentorStudent->mentor_user_id);
        $mentor->active_student_count--;
        $mentor->save();
    }

    private function getPrimaryBrandForAssigningMentor($userId): string
    {
        $primaryBrand = $this->primaryBrandService->getInitialBrand($userId);
        return $primaryBrand;
    }

    public function chooseMentor(string $brand): ?Mentor
    {
        $mentors = $this->getMentorsByBrand($brand);
        if ($mentors->count() == 0) {
            Log::warning("Unable to find mentor for brand '$brand'");
            return null;
        }
        $mentorsWithLowestStudentPercentage = $this->getMentorsWithLowestStudentPercentage($mentors);
        $index = rand(0, $mentorsWithLowestStudentPercentage->count() - 1);
        $mentor = $mentorsWithLowestStudentPercentage->values()[$index];
        if (!$mentor) {
            throw new Exception("Unable to choose a mentor for brand '$brand'");
        }
        return $mentor;
    }

    private function getMentorsWithLowestStudentPercentage($mentors): mixed
    {
        $lowestStudentPercentage = $mentors->map(fn(Mentor $t) => $t->getActiveStudentPercentage())->min();
        $mentorsWithLowestStudentPercentage = $mentors->where(
            fn($t) => $t->getActiveStudentPercentage() == $lowestStudentPercentage
        );
        return $mentorsWithLowestStudentPercentage;
    }

    private function getMentorsByBrand(string $brand): Collection
    {
        if (!$this->mentors) {
            $this->mentors = Mentor::all();
        }
        $mentors = $this->mentors->where(fn(Mentor $t) => Str::contains($t->supported_brands, $brand));
        return $mentors;
    }

    public function delete(int $mentorUserId): Collection
    {
        $mentorStudents = MentorStudent::query()
            ->with('user')
            ->where('mentor_user_id', '=', $mentorUserId)
            ->get();

        $mentor = $this->getMentorOrNull($mentorUserId);
        //clear supporting brands so reassignMentor will not be able to use this mentor
        $mentor->supported_brands = "";
        $mentor->save();
        $this->mentors = null; //refresh locally stored mentors in case it contains the mentor to be deleted

        $this->bulkReassignMentors($mentorStudents);
        $mentor->delete();
        return $mentorStudents;
    }

    public function getMentorIdByStudent(int $userId): ?int
    {
        /* @var ?MentorStudent $mentorStudent */
        $mentorStudent = MentorStudent::query()
            ->select('mentor_user_id')
            ->where('user_id', '=', $userId)
            ->first();
        return $mentorStudent?->mentor_user_id;
    }

    public function updateStudentMentor(int $userId, int $newMentorId): void
    {
        $mentorStudent = $this->getMentorStudentOrNull($userId);
        if (!$mentorStudent) {
            $mentorStudent = new MentorStudent();
            $mentorStudent->user_id = $userId;
        }

        $mentor = $this->getMentorOrNull($newMentorId);

        $mentorStudent->mentor_user_id = $mentor->user_id;
        if ($mentorStudent->isActive()) {
            $mentor->active_student_count += 1;
        }
        $mentor->total_student_count += 1;
        $mentor->save();
        $mentorStudent->save();
        event(StudentMentorsUpdated::newWithMentorStudent($mentorStudent));
    }

    private function getMentorStudentOrNull(int $userId): ?MentorStudent
    {
        /* @var ?MentorStudent $mentorStudent */
        $mentorStudent = MentorStudent::query()->where('user_id', '=', $userId)->first();
        return $mentorStudent;
    }

    public function getMentorOrNull(int $userId): ?Mentor
    {
        /* @var ?Mentor $mentor */
        $mentor = Mentor::query()->where('user_id', '=', $userId)->first();
        return $mentor;
    }

    public function updateMentor(int $userId, string $supportedBrands, int $activeStudentMaxCount): void
    {
        $mentor = $this->getMentorOrNull($userId);
        if (!$mentor) {
            $mentor = new Mentor();
            $mentor->user_id = $userId;
            $mentor->active_student_count = 0;
            $mentor->total_student_count = 0;
        }
        $mentor->supported_brands = $supportedBrands;
        $mentor->active_student_max_count = $activeStudentMaxCount;
        $mentor->save();
    }

    private function bulkReassignMentors(Collection $mentorStudents): void
    {
        $mentors = [];
        foreach ($mentorStudents as $mentorStudent) {
            /* @var MentorStudent $mentorStudent */
            if ($mentorStudent->isActive()) {
                $newMentor = $this->chooseNewMentor($mentorStudent);
                $mentorStudent->mentor_user_id = $newMentor->user_id;
                $newMentor->active_student_count += 1;
                $newMentor->total_student_count += 1;
                if (!array_key_exists($newMentor->user_id, $mentors)) {
                    $mentors[$newMentor->user_id] = $newMentor;
                }
            } else {
                $mentorStudent->mentor_user_id = '';
            }
        }

        $mentorStudents->groupBy('mentor_user_id')->each(function ($data, $mentorUserId) use ($mentors) {
            $ids = $data->map(fn($t) => $t->id);
            MentorStudent::query()->whereIn('id', $ids)->update(['mentor_user_id' => $mentorUserId]);
            if ($mentorUserId) {
                $newMentor = $mentors[$mentorUserId];
                $newMentor->save();
            }
            event(StudentMentorsUpdated::newWithMentorStudentCollection($data));
        });
    }

}
