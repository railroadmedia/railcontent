<?php

namespace App\Modules\Content\Services;

use App\Modules\Content\Models\ChallengeUserProgress;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;

class ChallengesAwardService
{

    public function __construct(
        private ChallengesService $challengesService,
    )
    {
    }

    /**
     * @param \Illuminate\Support\Collection $challengeProgress
     * @param string $brand
     * @return array
     */
    public function getBadgesData(Collection $challengeProgress, string $brand): array
    {
        $challengeIds = $challengeProgress->pluck('content_id')->toArray();
        $challenges = $this->challengesService->getChallengeByIds($challengeIds, $brand);
        $badges = [];
        $challenges = collect($challenges)->keyBy('content_id');
        foreach($challengeProgress as $progress) {
            $challenge = $challenges->get($progress->content_id);
            if ($challenge) {
                $badges[] = $this->getUserAwardData($challenge, $progress, user(), includeBase64: true);
            }
        }
        return $badges;
    }


    public function getUserAwardData(array $challenge, ChallengeUserProgress $userProgress, User $user, bool $includeBase64 = false): array
    {
        if  (is_null($userProgress->last_completed_date)) {
            return [];
        }
        $tier = $userProgress->getAwardTier()->value;
        $lastCompleted = Carbon::parse($userProgress->last_completed_date);
        $lastCompleted = $lastCompleted->toFormattedDateString();

        $ribbonUrl = "https://d3fzm1tzeyr5n3.cloudfront.net/challenges/{$tier}_ribbon.png";
        $musoraTextLogoUrl = 'https://d3fzm1tzeyr5n3.cloudfront.net/challenges/on_musora.png';
        $brandUrl = match($challenge['brand']) {
            'drumeo' => 'https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png',
            'singeo' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2021/singeo-logo.png',
            'guitareo' => 'https://d122ay5chh2hr5.cloudfront.net/sales/guitareo-logo-green.png',
            'pianote' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/marketing/pianote/membership/homepage/2023/pianote-logo-red.png'
        };
        $imageValues = [
            'award' => $challenge["{$tier}_award"],
            'instructor_signature' =>  $challenge['instructor_signature'],
            'musora_logo' => $musoraTextLogoUrl,
            'brand_logo' => $brandUrl,
            'ribbon_image' => $ribbonUrl,
        ];

        if ($includeBase64) {
            foreach ($imageValues as $key => $url) {
                $file = $url ? file_get_contents($url) : '';
                $imageValues[$key . '_64'] = base64_encode($file);
            }
        }
        $challengeFieldsToCopy = ['id', 'title', 'badge', 'artist_name', 'dark_mode_logo_url', 'light_mode_logo_url', 'logo_image_url'];
        $challengeValues = [];
        foreach($challengeFieldsToCopy as $fieldToCopy) {
            $challengeValues[$fieldToCopy] = $challenge[$fieldToCopy];
        }

        return [
            'user_name' => $user->display_name,
            'streak' => $userProgress->completed_best_streak,
            'minutes_practiced' => $userProgress->completed_time_practiced,
            'date_completed' => $lastCompleted,
            'challenge_title' => $challenge['title'],
            'award_text' => $challenge['award_custom_text'],
            'tier' => $tier,
            ... $imageValues,
            ... $challengeValues,
        ];
    }
}
