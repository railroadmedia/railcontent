<?php

namespace App\Modules\MusoraApi\Jobs;

use App\Jobs\BaseJob;
use App\Modules\EventTracking\Avo\AvoHelper;
use Avo;
use Log;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Models\Content;
use Railroad\Railcontent\Services\RecommendationService;

class ContentServedEventTrackingJob extends BaseJob
{
    public function __construct(private array $props, private User $user)
    {
    }

    public function handle(RecommendationService $recommendationService)
    {
        $recommended_content = [];

        foreach ($this->props['recommended_content'] as $contentServed) {
            /** @var Content $content */
            $content = Content::where('id', $contentServed['id'])->first();

            if (!$content) {
                Log::error('ContentServedEventTrackingJob: content not found', [
                    'content_id' => $contentServed['id']
                ]);
                continue;
            }

            $moduleSource = $recommendationService->getModuleSourceFromContent($this->user->id, $content);

            if (empty($moduleSource)) {
                Log::error('ContentServedEventTrackingJob: module source not found', [
                    'content_id' => $content->id
                ]);
                continue;
            }

            $recommended_content[] = [
                'content_id' => $content->id,
                'content_position' => $contentServed['position'],
                'module_source' => $moduleSource,
            ];
        }

        if (empty($recommended_content)) {
            return;
        }

        Avo::recommended_content_served(
            AvoHelper::defaultEventProperties(
                [
                    'brand' => $this->props['brand'] ?? null,
                    'navigation_section' => $this->props['navigation_section'],
                    'recommended_content' => $recommended_content,
                ],
                $this->user
            )
        );
    }
}
