<?php

namespace App\Modules\MusoraApi\Services\V5;

use App\Modules\EventTracking\Avo\AvoHelper;
use Avo;

class VideoJourneyService
{
    /**
     * @param array{
     *      brand: string,
     *      content_id: int,
     *      position_seconds: int,
     *      video_player: string,
     *      video_length_seconds: int,
     *      soundslice_slug: string
     * } $props
     *
     * @return void
     */
    public function trackVideoStarted(array $props): void
    {
        if ($props['video_player'] === 'soundslice') {
            Avo::video_started_soundslice(AvoHelper::defaultEventProperties($props));
            return;
        }

        Avo::video_started(AvoHelper::defaultEventProperties($props));
    }

    /**
     * @param array{
     *      brand: string,
     *      content_id: int,
     *      position_seconds: int,
     *      video_player: string,
     *      video_length_seconds: int,
     *      soundslice_slug: string
     * } $props
     *
     * @return void
     */
    public function trackVideoResumed(array $props): void
    {
        if ($props['video_player'] === 'soundslice') {
            Avo::video_resumed_soundslice(AvoHelper::defaultEventProperties($props));
            return;
        }

        Avo::video_resumed(AvoHelper::defaultEventProperties($props));
    }

    /**
     * @param array{
     *      brand: string,
     *      content_id: int,
     *      position_seconds: int,
     *      video_player: string,
     *      video_length_seconds: int,
     *      soundslice_slug: string
     * } $props
     *
     * @return void
     */
    public function trackVideoPlaying(array $props): void
    {
        if ($props['video_player'] === 'soundslice') {
            Avo::video_playing_soundslice(AvoHelper::defaultEventProperties($props));
            return;
        }

        Avo::video_playing(AvoHelper::defaultEventProperties($props));
    }

    /**
     * @param array{
     *      brand: string,
     *      content_id: int,
     *      position_seconds: int,
     *      video_player: string,
     *      video_length_seconds: int,
     *      soundslice_slug: string
     * } $props
     *
     * @return void
     */
    public function trackVideoPaused(array $props): void
    {
        if ($props['video_player'] === 'soundslice') {
            Avo::video_paused_soundslice(AvoHelper::defaultEventProperties($props));
            return;
        }

        Avo::video_paused(AvoHelper::defaultEventProperties($props));
    }

    /**
     * @param array{
     *      brand: string,
     *      content_id: int,
     *      position_seconds: int,
     *      video_player: string,
     *      video_length_seconds: int
     * } $props
     *
     * @return void
     */
    public function trackVideoCompleted(array $props): void
    {
        Avo::video_completed(AvoHelper::defaultEventProperties($props));
    }
}
