<?php

namespace App\Modules\Content\Services\V1;

use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Enums\ProgressState;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\Content\Models\ContentUserProgress;
use App\Modules\Content\Services\LearningPathsService;
use App\Modules\Content\Services\UserNotificationKeys;
use Illuminate\Database\Eloquent\Builder;
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
        private SanityGateway $sanity,
    ) {
    }

    public function getCarouselCards(string $brand): array
    {
        $user = user();
        $isAdmin = $user->isAdmin();

        $unfinishedOnboardingCards = [];
        // NOTE: Pack-only users doesn´t have membership level, and shouldn't have access to onboarding cards
        if ($user->membership_level) {
            $onboardingCardData = $this->learningPathsService->getNewLearningPaths();

            foreach ($onboardingCardData as $index => $onboardingCardDatum) {
                $onboardingCardData[$index]['show_everywhere'] = false;
                $onboardingCardData[$index]['type'] = 'onboarding';
                $progress = ContentUserProgress::getState($onboardingCardDatum['id'], $user->id);
                if ($progress->state == ProgressState::NotStarted) {
                    $unfinishedOnboardingCards[] = $onboardingCardData[$index];
                }
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
        $inProgressAndCompleted = ChallengeUserProgress::query()
            ->where('user_id', $user->id)
            ->where(function (Builder $builder) {
                return $builder->where('is_active', true)
                    ->orWhereNotNull('last_completed_date');
            })
            ->orderBy('start_date')
            ->get();

        $railcontentIds = $inProgressAndCompleted->pluck('content_id');
        $challengeRecommendations = collect($this->sanity->getChallengePromotionalBannerCards($brand, $isAdmin))
            ->filter(fn ($challenge) => !$railcontentIds->contains($challenge['id']));
        $allChallengeIds = [
            ...$badges->pluck('content_id'),
            ...$communityProgresses->pluck('content_id'),
            ...$soloProgresses->pluck('content_id'),
            ...$challengeRecommendations->pluck('id'),
        ];

        $allChallengeMetaData = $this->challengesService->getChallengeMetaDataForUserProgress(
            $allChallengeIds,
            $inProgressAndCompleted,
            returnChallengeData: true,
            brand: $brand
        );
        $allChallengeMetaData = collect($allChallengeMetaData)->keyby('content_id');

        $challengeRecommendationCards = $this->formatBannerCardFromChallenge($challengeRecommendations, $user, $allChallengeMetaData);

        $compiledCardData = [
            ... $this->formatChallengeAwardData($badges, $allChallengeMetaData),
            ... $this->formatChallengeData($communityProgresses, $allChallengeMetaData, 'active-community-challenge'),
            ... $this->formatChallengeData($soloProgresses, $allChallengeMetaData, 'active-solo-challenge'),
            ... $unfinishedOnboardingCards,
        ];
        // When custom cards are enabled, they should be added to the $challengeRecommendationCards for sorting.
        $compiledCardData = $this->sortBannerCards($compiledCardData, $challengeRecommendationCards); //2024-12-13T22:40:44.507073Z
        return $compiledCardData;
    }

    private function formatBannerCardFromChallenge($recommendations, $user, $allChallengeMetaData)
    {
        $enrollmentCards = [];
        $recommendations->map(function ($recommendation) use ($allChallengeMetaData, &$enrollmentCards, $user) {
            $enrollmentCards[] = [
                ...$allChallengeMetaData[$recommendation['id']],
                'type' => 'challenge-recommendation', // this is set after metadatum to override the existing type field
                'show_everywhere' => true,
                'enrolled_users' => $this->challengesService->getEnrolledUsersMetadata(
                    $recommendation['id'],
                ),
                'is_user_notified' => $this->challengesService->isUserNotifiedForChallenge($recommendation['id'], $user, UserNotificationKeys::ENROLLMENT_NOTIFICATION_KEY),
                'is_draft' => $recommendation['is_banner_draft'] ?? false,
                'display_order' => $recommendation['display_order'] ?? 0,
            ];
        });
        return $enrollmentCards;
    }

    private function sortBannerCards($immutableCards, $mutableCards)
    {
        $cardsWithDisplayOrder = [];
        $cardsWithoutDisplayOrder = [];
        foreach ($mutableCards as $card) {
            if (($card['display_order'] ?? 0) > 0) {
                $cardsWithDisplayOrder[] = $card;
            } else {
                $cardsWithoutDisplayOrder[] = $card;
            }
        }
        usort($cardsWithDisplayOrder, function ($a, $b) {
            return $a['display_order'] <=> $b['display_order'];
        });
        return [
            ... $cardsWithDisplayOrder,
            ... $immutableCards,
            ... $cardsWithoutDisplayOrder,
        ];
    }

    private function getCustomCards(string $brand, bool $isAdmin)
    {
        // Custom Cards
        //$promotionalCards = $this->sanity->getActiveBannerCards($brand, $showDrafts);
        // challenge banner cards

        // sort based on type, then display order
        // format for presentation
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
