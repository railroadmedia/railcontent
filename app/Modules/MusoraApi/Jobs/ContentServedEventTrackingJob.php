<?php

namespace App\Modules\MusoraApi\Jobs;

use App\Jobs\BaseJob;
use App\Modules\EventTracking\Avo\AvoHelper;
use Avo;
use Illuminate\Support\Facades\DB;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Models\Content;

class ContentServedEventTrackingJob extends BaseJob
{
    public function __construct(private array $props, private User $user)
    {
    }

    public function handle()
    {
        $recommended_content = [];

        foreach ($this->props['contents'] as $contentServed) {
            /** @var Content $content */
            $content = Content::where('id', $contentServed['id'])->first();

            if (!$content) {
                // TODO: Log no content found
                continue;
            }

            $brand = $content->brand;
            $type = str_replace('_', '-', $content->type);
            $moduleSource = null;

            $table = 'recommendations_' . $brand . $type;
            $beginnerTable = 'recommendations_' . $brand . $type . '_beginner_items';

            $recommendation = DB::table($table)
                ->where('user_id', $this->user->id)
                ->where('content_id', $content->id)
                ->first();

            $beginnerRecommendation = DB::table($beginnerTable)
                ->where('user_id', $this->user->id)
                ->where('content_id', $content->id)
                ->first();

            if ($recommendation) {
                $moduleSource = json_decode($recommendation->module_source);
            } elseif ($beginnerRecommendation) {
                $moduleSource = 'beginner';
            } else {
                // TODO: log no recommendation found
                continue;
            }

            $recommended_content[] = [
                'content_id' => $content->id,
                'content_position' => $contentServed['position'],
                'module_source' => $moduleSource,
            ];
        }

        if (emptyArray($recommended_content)) {
            // TODO: Log no recommended content found
            return;
        }

        Avo::recommended_content_served(
            AvoHelper::defaultEventProperties(
                [
                    'brand' => $props['brand'] ?? null,
                    'recommended_content' => $recommended_content,
                ],
                $this->user
            )
        );
    }
}
