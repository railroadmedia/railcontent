<?php

namespace App\Modules\MusoraApi\Jobs;

use App\Jobs\BaseJob;
use App\Modules\EventTracking\Avo\AvoHelper;
use Avo;
use Illuminate\Support\Facades\DB;
use Log;
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
                Log::error('Content not found', ['content_id' => $contentServed['id']]);
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

            if ($recommendation) {
                $moduleSource = json_decode($recommendation->module_source);
            } else {
                $beginnerRecommendation = DB::table($beginnerTable)
                    ->where('user_id', $this->user->id)
                    ->where('content_id', $content->id)
                    ->first();

                if (!$beginnerRecommendation) {
                    Log::error(self::class . ': Content not found', ['content_id' => $contentServed['id']]);
                    return;
                }

                $moduleSource = 'beginner';
            }

            $recommended_content[] = [
                'content_id' => $content->id,
                'content_position' => $contentServed['position'],
                'module_source' => $moduleSource,
            ];
        }

        if (emptyArray($recommended_content)) {
            Log::error('No recommended content found for contents served', ['content_id' => $this->props['content_id']]);
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
