<?php

namespace App\Modules\Mentor\Services;


use App\Modules\Brand\Services\PrimaryBrandService;
use App\Modules\Mentor\Events\StudentMentorsUpdated;
use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Models\MentorStudent;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Str;

class MentorService
{
    private PrimaryBrandService $primaryBrandService;
    private ?Collection $mentors = null;
    /**
     * Only needed to disable assigned when membership_expiration_date is set, can be removed after MWP Launched
     */
    private bool $disableAssigningOnLaunch;

    public function __construct(PrimaryBrandService $primaryBrandService, bool $disableAssigningOnLaunch = false)
    {
        $this->primaryBrandService = $primaryBrandService;
        $this->disableAssigningOnLaunch = $disableAssigningOnLaunch;
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
        }
        return $this->assignMentorByBrand($userId, $brand);
    }

    public function assignMentorByBrand(int $userId, string $brand): bool
    {
        $mentor = $this->chooseMentor($brand);
        if (!$mentor) {
            Log::error("Unable to assign Mentor to User $userId");
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
        Log::info("Assigned Mentor $mentor->user_id to User $userId");
        return true;
    }

    private function chooseNewMentor(MentorStudent $mentorStudent, int $ignoreMentorUserID): ?Mentor
    {
        $brand = $mentorStudent->primary_brand;
        if (!$brand) {
            $brand = $this->getPrimaryBrandForAssigningMentor($mentorStudent->user_id);
        }
        $mentor = $this->chooseMentor($brand, $ignoreMentorUserID);
        return $mentor;
    }


    public function ensureMentorState(User $user): EnsureMentorResult
    {
        if ($this->disableAssigningOnLaunch) {
            return EnsureMentorResult::NoChange;
        }

        $active = $user->isActiveStudent();
        $mentorStudent = $user->mentorStudent;
        if ($active && (!$mentorStudent || !$mentorStudent->mentor_user_id)) {
            if ($this->assignMentor($user->id)) {
                return EnsureMentorResult::MentorAssigned;
            }
        }

        return EnsureMentorResult::NoChange;
    }

    public function recalculateMentorTotals(Mentor $mentor)
    {
        $data = MentorStudent::query()
            ->join(
                'usora_users',
                'usora_users.id',
                '=',
                'mentor_students.user_id'
            )
            ->where('mentor_user_id', '=', $mentor->user_id)
            ->select('usora_users.membership_expiration_date', 'usora_users.id')
            ->get();

        $mentor->total_student_count = $data->count();
        $mentor->active_student_count = $data
            ->where(
                'membership_expiration_date',
                '>=',
                Carbon::now()->addDays(-config('mentor.active_after_membership_expired_days'))
            )
            ->count();
        $mentor->save();
    }

    private function getPrimaryBrandForAssigningMentor($userId): string
    {
        $primaryBrand = $this->primaryBrandService->getInitialBrand($userId);
        return $primaryBrand;
    }

    public function chooseMentor(string $brand, int $ignoreMentorUserId = 0): ?Mentor
    {
        $mentors = $this->getMentorsByBrand($brand);
        if ($ignoreMentorUserId > 0) {
            $mentors = $mentors->where('user_id', '!=', $ignoreMentorUserId);
        }
        if ($mentors->count() == 0) {
            Log::error("Unable to find mentor for brand '$brand'");
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
        $this->resetCachedMentors(); //refresh locally stored mentors in case it contains the mentor to be deleted

        $this->bulkReassignMentors($mentorStudents, $mentorUserId);
        $mentor->delete();
        return $mentorStudents;
    }

    public function reassignRandomStudents(int $mentorUserId, int $nStudents): void
    {
        $mentor = $this->getMentorOrNull($mentorUserId);
        if (!$mentor) {
            throw new Exception('Mentor does not exist');
        }
        $mentorStudents = MentorStudent::query()
            ->with('user')
            ->join(
                'usora_users',
                'usora_users.id',
                '=',
                'mentor_students.user_id'
            )->where('mentor_user_id', '=', $mentorUserId)
            ->where(
                'usora_users.membership_expiration_date',
                '>',
                Carbon::now()->addDays(-config('mentor.active_after_membership_expired_days'))
            )
            ->select('mentor_students.*')
            ->inRandomOrder()
            ->take($nStudents)
            ->get();
        $this->bulkReassignMentors($mentorStudents, $mentorUserId);
        $this->recalculateMentorTotals($mentor);
    }

    public function resetCachedMentors()
    {
        $this->mentors = null;
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

    public function updateStudentMentor(int $userId, ?int $newMentorId): void
    {
        $mentorStudent = $this->getMentorStudentOrNull($userId);
        if (!$mentorStudent) {
            $mentorStudent = new MentorStudent();
            $mentorStudent->user_id = $userId;
        }


        $mentor = $this->getMentorOrNull($newMentorId);

        $mentorStudent->mentor_user_id = $mentor?->user_id;
        if ($mentor) {
            if ($mentorStudent->isActive()) {
                $mentor->active_student_count += 1;
            }
            $mentor->total_student_count += 1;
            $mentor->save();
        }
        $mentorStudent->save();
        event(StudentMentorsUpdated::newWithMentorStudent($mentorStudent));
    }

    private function getMentorStudentOrNull(int $userId): ?MentorStudent
    {
        /* @var ?MentorStudent $mentorStudent */
        $mentorStudent = MentorStudent::query()->where('user_id', '=', $userId)->first();
        return $mentorStudent;
    }

    public function getMentorOrNull(?int $userId): ?Mentor
    {
        if (!$userId) {
            return null;
        }
        /* @var ?Mentor $mentor */
        $mentor = Mentor::query()->where('user_id', '=', $userId)->first();
        return $mentor;
    }

    public function updateMentor(int $mentorUserId, string $supportedBrands, int $activeStudentMaxCount): void
    {
        $mentor = $this->getMentorOrNull($mentorUserId);
        if (!$mentor) {
            $mentor = new Mentor();
            $mentor->user_id = $mentorUserId;
            $mentor->active_student_count = 0;
            $mentor->total_student_count = 0;
        }
        $mentor->supported_brands = $supportedBrands;
        $mentor->active_student_max_count = $activeStudentMaxCount;
        $mentor->save();
    }

    private function bulkReassignMentors(Collection $mentorStudents, int $ignoreMentorUserID): void
    {
        $mentors = [];
        foreach ($mentorStudents as $mentorStudent) {
            /* @var MentorStudent $mentorStudent */
            if ($mentorStudent->isActive()) {
                $newMentor = $this->chooseNewMentor($mentorStudent, $ignoreMentorUserID);
                if ($newMentor == null) {
                    throw new Exception("Unable to reassign User to Mentor $mentorStudent->user_id");
                }
                $mentorStudent->mentor_user_id = $newMentor->user_id;
                if (!array_key_exists($newMentor->user_id, $mentors)) {
                    $mentors[$newMentor->user_id] = $newMentor;
                }
            } else {
                $mentorStudent->mentor_user_id = null;
            }
        }

        $mentorStudents->groupBy('mentor_user_id')->each(function ($data, $mentorUserId) use ($mentors) {
            $ids = $data->map(fn($t) => $t->id);

            MentorStudent::query()->whereIn('id', $ids)->update(
                ['mentor_user_id' => $mentorUserId ? $mentorUserId : null]
            );
            if ($mentorUserId) {
                $newMentor = $mentors[$mentorUserId];
                $this->recalculateMentorTotals($newMentor);
            }
            event(StudentMentorsUpdated::newWithMentorStudentCollection($data));
        });
    }

}
