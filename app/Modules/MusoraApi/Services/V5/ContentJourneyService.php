<?php

namespace App\Modules\MusoraApi\Services\V5;

use App\Modules\EventTracking\Avo\AvoHelper;
use Avo;

class ContentJourneyService
{
    /**
     * @param array{
     *      brand: string,
     *      content_id: int,
     * } $props
     *
     * @return void
     */
    public function trackContentLiked(array $props): void
    {
        Avo::content_liked(AvoHelper::defaultEventProperties($props));
    }

    /**
     * @param array{
     *      brand: string,
     *      content_id: int,
     * } $props
     *
     * @return void
     */
    public function trackContentUnliked(array $props): void
    {
        Avo::content_unliked(AvoHelper::defaultEventProperties($props));
    }
}
