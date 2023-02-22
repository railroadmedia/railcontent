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

    public function __construct(int $skip, int $take)
    {
        $this->skip = $skip;
        $this->take = $take;
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
        return MentorStudent::query();
    }

    function handleItem($item): void
    {
    }

    function handleAllItems($items): bool
    {
        dispatch_sync((new CustomerIoSyncMentor(StudentMentorsUpdated::newWithMentorStudentCollection($items)->mentorStudentData)));
        return true;
    }
}
