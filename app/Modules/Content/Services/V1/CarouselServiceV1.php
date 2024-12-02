<?php

namespace App\Modules\Content\Services\V1;

use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Services\LearningPathsService;
use App\Modules\FeatureFlagging\Facades\FeatureFlagging;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use App\Modules\Content\Services\ChallengesAwardService;
use App\Modules\Content\Services\ChallengesService;

class CarouselServiceV1
{
    public function __construct(
        private ChallengesService $challengesService,
        private ChallengesAwardService $challengesAwardService,
        private LearningPathsService $learningPathsService,
        private SanityGateway $sanity
    ) {
    }

    public function getCarouselCards(string $brand): array
    {
        $user = user();

        // TODO: update challenge cards to match schema for Sanity and FE/MA

        // TODO TCH-112 - bundle import for challenges from sanity

        // TODO: fetch onboarding recommendations from Sanity
        // TODO: remove if the user has started the lesson
        $onboardingCardData = $this->learningPathsService->getNewLearningPaths(boolval(FeatureFlagging::branch('homepage-v2', user())));
        foreach ($onboardingCardData as $index => $onboardingCardDatum) {
            $onboardingCardData[$index]['show_everywhere'] = false;
            $onboardingCardData[$index]['type'] = 'onboarding';
            if ($onboardingCardDatum['content_type'] == 'challenge') {
                $onboardingCardData[$index]['button']['page_params']['isChallenge'] = true;
            }
        }

        // all badges from the last day
        $badges = $user->challengeProgress()
            ->brand($brand)
            ->completed()
            ->showBadgeInBanner()
            ->where('last_completed_date', '>', Carbon::now()->subDays(1))
            ->get();

        // enrolled & active community challenges (max 1)
        $communityProgresses = $user->challengeProgress()
            ->brand($brand)
            ->community()
            ->active()
            ->where('updated_at', '>', Carbon::now()->subDays(30))
            ->orderBy('updated_at', 'desc')
            ->take(1)
            ->get();

        // active solo challenges (max 3)
        $soloProgresses = user()->challengeProgress()
            ->brand($brand)
            ->active()
            ->solo()
            ->where('updated_at', '>', Carbon::now()->subDays(30))
            ->orderBy('updated_at', 'desc')
            ->take(3)
            ->get();

        // Challenge with open enrollment (that the user is not a part of)
        $allProgress = $user->challengeProgress()->brand($brand)->active()->get();
        $railcontentIds = $allProgress->pluck('content_id');
        $challengeRecommendation = collect($this->sanity->getChallengesWithOpenEnrollment($brand))
            ->filter(fn ($challenge) => !$railcontentIds->contains($challenge['id']))
            ->take(1);
        $allChallengeIds = [
            ...$badges->pluck('content_id'),
            ...$communityProgresses->pluck('content_id'),
            ...$soloProgresses->pluck('content_id'),
            ...$challengeRecommendation->pluck('id'),
        ];


        $allChallengeMetaData = $this->challengesService->getChallengeMetaDataForUserProgress($allChallengeIds, $allProgress, returnChallengeData: true, brand: $brand);
        $allChallengeMetaData = collect($allChallengeMetaData)->keyby('content_id');
        $challengeRecommendationCard = $challengeRecommendation->isEmpty() ? [] :
            [
                ...$allChallengeMetaData[$challengeRecommendation[0]['id']],
                'type' => 'challenge-recommendation', // this is set after metadatum to override the existing type field
                'show_everywhere' => true,
                'enrolled_users' => $this->challengesService->getEnrolledUsersMetadata($challengeRecommendation[0]['id'])
            ];
        $compiledCardData = [
            ... $this->formatChallengeAwardData($badges, $allChallengeMetaData),
            ... $this->formatChallengeData($communityProgresses, $allChallengeMetaData, 'active-community-challenge'),
            ... $this->formatChallengeData($soloProgresses, $allChallengeMetaData, 'active-solo-challenge'),
            ... $onboardingCardData,
        ];
        if ($challengeRecommendationCard) {
            $compiledCardData[] = $challengeRecommendationCard;
        }

        return $compiledCardData;
    }

    private function formatChallengeData(mixed $userProgresses, Collection $challengeMetaData, string $type) : array
    {
        $compiledCardData = [];
        foreach($userProgresses as $userProgress) {
            $id = $userProgress['content_id'] ?? $userProgress['id'];
            $challengeMetaDatum = $challengeMetaData[$userProgress->content_id];
            if ($challengeMetaDatum) {
                $compiledCardData[] = [
                    ...$challengeMetaDatum,
                    'type' => $type, // this is set after metadatum to override the existing type field
                    'show_everywhere' => true,
                ];
            }
        }
        return $compiledCardData;
    }

    private function formatChallengeAwardData(Collection $userProgresses, Collection $challengeMetaData) : array
    {
        $compiledCardData = [];
        foreach($userProgresses as $userProgress) {
            $challengeMetaDatum = $challengeMetaData[$userProgress->content_id];
            if ($challengeMetaDatum) {
                $awardData = $this->challengesAwardService->getUserAwardData(
                    $challengeMetaDatum,
                    $userProgress,
                    user()
                );
                $compiledCardData[] = [
                    'type' => 'challenge-award',
                    'brand' => $challengeMetaDatum['brand'],
                    'show_everywhere' => true,
                    ...$awardData,
                ];
            }
        }
        return $compiledCardData;
    }
}
