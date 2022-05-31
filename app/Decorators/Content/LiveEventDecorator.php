<?php

namespace App\Decorators\Content;

use Carbon\Carbon;
use Exception;
use Railroad\Railcontent\Support\Collection;

class LiveEventDecorator extends TypeDecoratorBase
{

    const NOT_LIVE_PAGE_SWITCH_MINUTES = 30;

    /**
     * @param Collection $contents
     * @return Collection
     */
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->whereIn('type', config('railcontent.liveContentTypes', []));

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        foreach ($contentsOfType as $contentIndex => $content) {

            if (empty($content->fetch('fields.live_event_start_time')) ||
                empty($content->fetch('fields.live_event_end_time'))) {
                continue;
            }

            try {
                $startTimeUtc = Carbon::parse($content->fetch('fields.live_event_start_time'));
                $endTimeUtc = Carbon::parse($content->fetch('fields.live_event_end_time'));

                if (Carbon::now() > $startTimeUtc->subMinutes(self::NOT_LIVE_PAGE_SWITCH_MINUTES) &&
                    Carbon::now() < $endTimeUtc->addMinutes(self::NOT_LIVE_PAGE_SWITCH_MINUTES)) {
                    $contentsOfType[$contentIndex]['isLive'] = true;
                } else {
                    $contentsOfType[$contentIndex]['isLive'] = false;
                }
            } catch (Exception $exception) {
                error_log($exception);

                $contentsOfType[$contentIndex]['isLive'] = false;
            }

            if (!$content->fetch('data.thumbnail_url')) {
                $content['data'][] = [
                    'content_id' => $content['id'],
                    'key' => 'thumbnail_url',
                    'value' => config('railcontent.defaultThumb'),
                    'position' => 1,
                ];
            }

        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
