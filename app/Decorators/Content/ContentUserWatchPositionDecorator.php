<?php

namespace App\Decorators\Content;

use App\Modules\Tracker\Models\LastEngagedSeconds;
use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Support\Collection;
use App\Modules\RailTracker\Repositories\MediaPlaybackRepository;

class ContentUserWatchPositionDecorator extends \Railroad\Railcontent\Decorators\ModeDecoratorBase
{
    private MediaPlaybackRepository $mediaPlaybackRepository;

    public function __construct(MediaPlaybackRepository $mediaPlaybackRepository)
    {
        $this->mediaPlaybackRepository = $mediaPlaybackRepository;
    }

    public function decorate(Collection $contents, $userId = null)
    {
        if (self::$decorationMode !== self::DECORATION_MODE_MAXIMUM) {
            return $contents;
        }

        if (empty($userId) && !empty(auth()->id())) {
            $userId = auth()->id();
        }

        if (empty($userId)) {
            return $contents;
        }

        $contentsOfType = $contents->whereIn('type', ['style','artist']);

        if ($contentsOfType->isNotEmpty()) {
            return $contents;
        }

        $contentIds = $contents->map(function ($item) {
            return $item['id'];
        })->toArray();

        $lastEngagedLookup = LastEngagedSeconds::query()
            ->where('user_id', '=', $userId)
            ->whereIn('content_id', $contentIds)->get()->groupBy(
                function ($item) {
                    return $item['content_id'];
                }
            );

        foreach ($contents as $index => $content) {
            /** @var LastEngagedSeconds $lastEngaged */
            $lastEngaged = $lastEngagedLookup[$content['id']][0] ?? null;
            if ($lastEngaged) {
                $seconds = $lastEngaged->resume_time_seconds ?? 0;
                $contents[$index]['last_watch_position_in_seconds'] = $seconds;
            }
        }

        return new Collection($contents);
    }
}
