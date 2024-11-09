<?php

namespace App\Modules\Content\Models;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Content\Enums\ProgressState;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\UserManagementSystem\Models\User;

/**
 * App\Modules\Content\Models\Content
 *
 * @property int $id
 * @property int $content_id
 * @property int $user_id
 * @property string $state
 * @property int $progress_percent
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'content_id');
    }

    public static function isCompletedByUser(int $contentId, int $userId): bool
    {
        return self::where('content_id', $contentId)
            ->where('user_id', $userId)
            ->where('state', ProgressState::Completed->value)
            ->exists();
    }

    /**
     * Scope a query to only include records that are not complete.
     */
    public function scopeIncomplete(Builder $query): Builder
    {
        return $query->whereNot('state', ProgressState::Completed->value);
    }

    /**
     * Scope a query to only include records that are complete.
     */
    public function scopeComplete(Builder $query): Builder
    {
        return $query->where('state', ProgressState::Completed->value);
    }

    /**
     * Scope a query to only include progress for content of a given type.
     */
    public function scopeOfContentType(Builder $query, string $type): Builder
    {
        return $query->whereHas('content', function ($query) use ($type) {
            $query->where('type', $type);
        });
    }

    /**
     * Scope a query to only include progress for content with a given brand.
     */
    public function scopeOfContentBrand(Builder $query, Brand $brand): Builder
    {
        return $query->whereHas('content', function ($query) use ($brand) {
            $query->where('brand', $brand->value);
        });
    }

    /**
     * Get the state of the progress for the content and user provided.
     *
     * @throws Exception
     */
    public static function getState(int $contentId, int $userId): object
    {
        /** @var Collection<ContentUserProgress> $progressCollection */
        $progressCollection = self::where('content_id', $contentId)
            ->where('user_id', $userId)
            ->get();

        if ($progressCollection->count() > 1) {
            throw new Exception(
                sprintf(
                    'Multiple %s found for Content %s and User %s',
                    class_basename(__CLASS__),
                    $contentId,
                    $userId
                )
            );
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

    public static function getAllProgressDataByUser(int $userId): \Illuminate\Support\Collection
    {
        return self::query()->select(['content_id', 'state', 'progress_percent', 'updated_on'])->where('user_id', $userId)->get();
    }
}
