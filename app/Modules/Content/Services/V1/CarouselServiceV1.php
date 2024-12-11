<?php

namespace App\Modules\Content\Services\V1;

use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Enums\ProgressState;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\Content\Models\ContentUserProgress;
use App\Modules\Content\Services\ContentProgressService;
use App\Modules\Content\Services\LearningPathsService;
use App\Modules\FeatureFlagging\Facades\FeatureFlagging;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use App\Modules\Content\Services\ChallengesAwardService;
use App\Modules\Content\Services\ChallengesService;
use Railroad\Railcontent\Services\UserContentProgressService;

class CarouselServiceV1
{
    public function __construct(
        private ChallengesService $challengesService,
        private ChallengesAwardService $challengesAwardService,
        private LearningPathsService $learningPathsService,
        private SanityGateway $sanity,
    ) {
    }

    public function getCarouselCards(string $brand): array
    {
        $user = user();
        $isAdmin = $user->isAdmin();
        // TODO Adrian this needs to be updated
        //$promotionalCards = $this->getSortedPromotionalCards($brand, $isAdmin);

        $onboardingCardData = $this->learningPathsService->getNewLearningPaths();
        $unfinishedOnboardingCards = [];
        foreach ($onboardingCardData as $index => $onboardingCardDatum) {
            $onboardingCardData[$index]['show_everywhere'] = false;
            $onboardingCardData[$index]['type'] = 'onboarding';
            $progress = ContentUserProgress::getState($onboardingCardDatum['id'], $user->id);
            if ($progress->state == ProgressState::NotStarted) {
                $unfinishedOnboardingCards[] = $onboardingCardData[$index];
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
            ->currentlyActive()
            ->locked()
            ->where('updated_at', '>', Carbon::now()->subDays(30))
            ->orderBy('updated_at', 'desc')
            ->take(1)
            ->get();

        // active solo challenges (max 3)
        $soloProgresses = user()->challengeProgress()
            ->brand($brand)
            ->currentlyActive()
            ->solo()
            ->locked()
            ->where('updated_at', '>', Carbon::now()->subDays(30))
            ->orderBy('updated_at', 'desc')
            ->take(3)
            ->get();


        // Challenge with open enrollment (that the user is not a part of)
        $allProgress = ChallengeUserProgress::whereUserIdAndActive($user->id);
        $railcontentIds = $allProgress->pluck('content_id');
        $challengeRecommendations = collect($this->sanity->getChallengeOpenEnrollmentCards($brand, $isAdmin))
            ->filter(fn($challenge) => !$railcontentIds->contains($challenge['id']));
        $allChallengeIds = [
            ...$badges->pluck('content_id'),
            ...$communityProgresses->pluck('content_id'),
            ...$soloProgresses->pluck('content_id'),
            ...$challengeRecommendations->pluck('id'),
        ];


        $allChallengeMetaData = $this->challengesService->getChallengeMetaDataForUserProgress(
            $allChallengeIds,
            $allProgress,
            returnChallengeData: true,
            brand: $brand
        );
        $allChallengeMetaData = collect($allChallengeMetaData)->keyby('content_id');
        $challengeRecommendationCards = [];
        $challengeRecommendations->map(function($recommendation) use ($allChallengeMetaData, &$challengeRecommendationCards) {
           $challengeRecommendationCards[] = [
               ...$allChallengeMetaData[$recommendation['id']],
               'type' => 'challenge-recommendation', // this is set after metadatum to override the existing type field
               'show_everywhere' => true,
               'enrolled_users' => $this->challengesService->getEnrolledUsersMetadata(
                   $recommendation['id'],
               ),
               'is_draft' => $recommendation['is_banner_draft'] ?? false,
           ];
        });
        $compiledCardData = [
            ... $this->formatChallengeAwardData($badges, $allChallengeMetaData),
            ... $this->formatChallengeData($communityProgresses, $allChallengeMetaData, 'active-community-challenge'),
            ... $this->formatChallengeData($soloProgresses, $allChallengeMetaData, 'active-solo-challenge'),
            ... $unfinishedOnboardingCards,
            ... $challengeRecommendationCards,
        ];

        return $compiledCardData;
    }

    private function getSortedPromotionalCards(string $brand, bool $showDrafts)
    {
        // Custom Cards
        $promotionalCards = $this->sanity->getActiveBannerCards($brand, $showDrafts);
        // challenge banner cards

        // sort based on type, then display order
        // format for presentation
        return $promotionalCards;
    }

    private function formatChallengeData(mixed $userProgresses, Collection $challengeMetaData, string $type): array
    {
        $compiledCardData = [];
        foreach ($userProgresses as $userProgress) {
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

    private function formatChallengeAwardData(Collection $userProgresses, Collection $challengeMetaData): array
    {
        $compiledCardData = [];
        foreach ($userProgresses as $userProgress) {
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
