<?php

namespace App\Modules\Content\Models;

use App\Modules\Content\Enums\ProgressState;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Content\Models\Content
 *
 * @property integer $id
 * @property integer $content_id
 * @property integer $user_id
 * @property string $state
 * @property integer $progress_percent
 * @property string $higher_key_progress
 * @property Carbon $updated_on
 * @property Carbon $started_on
 * @property Carbon $completed_on
 */
class ContentUserProgress extends Model
{
    protected $table = 'railcontent_user_content_progress';
    public $timestamps = false;
    protected $guarded = ['id'];

    public static function isCompletedByUser(int $contentId, int $userId): bool
    {
        return self::where('content_id', $contentId)
        ->where('user_id', $userId)
        ->where('state', ProgressState::Completed->value)
        ->exists();
    }

    /**
     * Get the state of the progress for the content and user provided.
     *
     * @return object{state: ProgressState, percent: int}
     * @throws Exception
     */
    public static function getState(int $contentId, int $userId): object
    {
        /** @var Collection<ContentUserProgress> $progressCollection */
        $progressCollection = self::where('content_id', $contentId)
            ->where('user_id', $userId)
            ->get();

        if ($progressCollection->count() > 1) {
            throw new Exception(sprintf(
                'Multiple %s found for Content %s and User %s',
                class_basename(__CLASS__),
                $contentId,
                $userId
            ));
        }

        return new class ($progressCollection) {
            public ProgressState $state;
            public int $percent;

            public function __construct(Collection $progressCollection)
            {
                if ($progressCollection->isEmpty()) {
                    $this->state = ProgressState::NotStarted;
                    $this->percent = 0;
                } else {
                    $this->state = ProgressState::tryFrom($progressCollection->first()->state);
                    $this->percent = $progressCollection->first()->progress_percent;
                }
            }

            public function toArray(): array
            {
                return [
                    'state' => $this->state->value,
                    'percent' => $this->percent
                ];
            }
        };
    }
}
