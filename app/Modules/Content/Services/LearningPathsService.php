<?php

namespace App\Modules\Content\Services;

use App\Models\Brand;
use App\Models\TrialSection;
use Railroad\Railcontent\Services\ContentService;

class LearningPathsService
{
    private ContentService $contentService;

    public function __construct(
        ContentService $contentService
    ) {
        $this->contentService = $contentService;
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
                    auth()->id()
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
        return $user->is_trial
            && $user->created_at->diffInDays(now()) <= 30
            && FeatureFlagging::branch('homepage-learning-path-redesign', $user) === 'experiment';
    }

    public function getNewLearningPaths(): array
    {
        $brand = brand();
        if ($brand !== 'drumeo' && $brand !== 'pianote') {
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

        return config('learning.v2.' . $brand . '.' . $user->membership_level)[$experienceLevel] ?? [];
    }
}
