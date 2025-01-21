<?php

namespace App\Modules\UserManagementSystem\Jobs;

use App\Modules\FeatureFlagging\Facades\FeatureFlagging;
use App\Modules\UserManagementSystem\Enums\OnboardingSkillLevelEnum;
use App\Services\PlaylistService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\UserManagementSystem\Models\User;

class SetDefaultPlaylistsJob implements ShouldQueue
{
    use Dispatchable;

    public function __construct(
        private readonly User $user,
        private readonly string $brand,
        private readonly OnboardingSkillLevelEnum $skillLevel,
    ) {
    }

    public function handle(): void
    {
        if (boolval(FeatureFlagging::branch('homepage-v2', $this->user))) {
            /** @var PlaylistService $playlistService */
            $playlistService = app(PlaylistService::class);

            $playlists = config('onboarding.default_playlists.'.$this->brand.'.'.$this->skillLevel->name);

            foreach ($playlists as $playlistId) {
                $playlistService->copyPlaylist($this->user->id, $playlistId);
            }
        }
    }
}
