<?php

namespace App\Modules\Mentor\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncMentor;
use App\Modules\Mentor\Events\StudentMentorsUpdated;
use App\Modules\Mentor\Models\MentorStudent;
use Illuminate\Database\Eloquent\Builder;

class SyncMentorsWithCustomerIOJob extends BatchQueryJob
{
    private int $skip;
    private int $take;
    private ?int $mentorUserId;

    public function __construct(int $skip, int $take, ?int $mentorUserID = 0)
    {
        $this->skip = $skip;
        $this->take = $take;
        $this->mentorUserId = $mentorUserID;
    }

    function getSkip(): int
    {
        return $this->skip;
    }

    function getTake(): int
    {
        return $this->take;
    }

    function getQuery(): Builder
    {
        $query = MentorStudent::query();
        if ($this->mentorUserId) {
            $query = $query->where("mentor_user_id", "=", $this->mentorUserId);
        }
        return $query;
    }

    function handleItem($item): void
    {
    }

    function handleAllItems($items): bool
    {
        dispatch_sync(
            (new CustomerIoSyncMentor(StudentMentorsUpdated::newWithMentorStudentCollection($items)->mentorStudentData))
        );
        return true;
    }
}
