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
}
