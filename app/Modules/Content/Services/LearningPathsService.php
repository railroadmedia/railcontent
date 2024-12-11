<?php

namespace App\Modules\Content\Services;

use App\Models\Brand;
use App\Models\TrialSection;
use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\UserManagementSystem\Enums\OnboardingSkillLevelEnum;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Railroad\Railcontent\Services\ContentService;

class LearningPathsService
{
    public function __construct(
        private ContentService $contentService,
        private SanityGateway $sanityGateway,
    ) {
        ;
    }

    public function getLearningPaths()
    {
        $brandId =
            Brand::query()
                ->where('name', brand())
                ->first()->id;

        $learningPaths =
            TrialSection::query()
                ->where('brand_id', $brandId)
                ->orderBy('display_order')
                ->get();

        $learningPaths->each(function (TrialSection $section) {
            $content = $this->contentService->getById($section->product_id);
            $section->bgImg = $section->desktop_img;
            $section->topPillText = $section->tagline ?? '';
            $section->content_type = $content['type'] ?? '';
            $section->ctaUrl = $content['url'] ?? '';
            if ($content['type'] == "learning-path") {
                $nextContentForUser = $this->contentService->getNextContentForParentContentForUser(
                    $content['id'],
                    Auth::id()
                );
                $section->ctaUrl = $nextContentForUser['url'];
            }

            $section->ctaText = ($content['completed']) ? 'Completed' : ((!$content['started']) ? 'Start now' : 'Continue');
            $section->state = ($content['completed']) ? 'completed' : ((!$content['started']) ? 'start' : 'continue');
        });

        return $learningPaths;
    }

    public function showLearningPaths(string $brand): bool
    {
        $hideSection = $brand . '_trial_section_hide';
        if (user()->is_trial && !user()->$hideSection && user()->created_at->diffInDays(now()) <= 30) {
            $hasExperienceLevels = count(
                user()->onboardingExperience->filter(function ($item) use ($brand) {
                    return $item->brand == $brand && ($item->experience_level == 0 || $item->experience_level == 1);
                })
            ) > 0;

            return ($hasExperienceLevels) ? true : false;
        }
        return false;
    }

    public function showNewLearningPaths(): bool
    {
        $user = user();
        return Carbon::parse($user->created_at)->greaterThanOrEqualTo(Carbon::now()->subDays(30));
    }

    public function getNewLearningPaths(): array
    {
        $brand = brand();
        if (!$this->showNewLearningPaths()) {
            return [];
        }

        $user = user();
        $experienceLevel = intval(
            $user
                ->onboardingExperience
                ->where('brand', brand())
                ->first()
                ->experience_level ?? 0
        );
        $difficultyString = OnboardingSkillLevelEnum::tryFrom($experienceLevel)->name;
        $document = $this->sanityGateway->getOnboardingCard($brand, $user->membership_level, $difficultyString) ?? [];
        return [
            $document['first_content'],
            $document['second_content'],
        ];
    }
}
