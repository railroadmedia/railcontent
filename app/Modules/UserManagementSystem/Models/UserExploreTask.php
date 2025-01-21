<?php

namespace Modules\UserManagementSystem\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class UserExploreTask extends Model
{
    protected $table = 'user_explore_tasks';

    protected $fillable = [
        'task_id',
        'is_completed',
        'completed_at',
        'expires_at',
    ];

    protected $with = ['task'];

    public function task(): BelongsTo
    {
        return $this->belongsTo(ExploreTask::class, 'task_id');
    }

    public function scopeUncompleted($query)
    {
        return $query->where('is_completed', false);
    }

    public function scopeNotExpired(Builder $query)
    {
        return $query->where('expires_at', '>', Carbon::now())->orWhereNull('expires_at');
    }

    public function scopeByHook(Builder $query, string $hook)
    {
        return $query->whereHas('task', function ($query) use ($hook) {
            $query->where('hook', $hook);
        });
    }

    public function isLeavingSoon(): bool
    {
        return $this->expires_at && Carbon::parse($this->expires_at)->diffInDays(now()) <= 7;
    }
}
