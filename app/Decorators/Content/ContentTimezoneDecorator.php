<?php

namespace App\Decorators\Content;

use App\Maps\ContentTypes;
use Carbon\Carbon;
use Railroad\Railcontent\Support\Collection;

class ContentTimezoneDecorator extends TypeDecoratorBase
{
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->whereIn('type', ContentTypes::searchableContentTypes());

        if ($contentsOfType->isEmpty() || empty(auth()->user())) {
            return $contents;
        }

        $timezone = user()->timezone ?? 'America/Los_Angeles';

        foreach ($contentsOfType as $contentIndex => $content) {
            if (!empty($content->fetch('fields.live_event_start_time'))) {
                try {
                    $contentsOfType[$contentIndex]['live_event_start_time_in_timezone'] =
                        Carbon::parse($content->fetch('fields.live_event_start_time'), 'UTC')
                            ->timezone($timezone)->toDateTimeString();
                } catch (\Exception $exception) {
                    $contentsOfType[$contentIndex]['live_event_start_time_in_timezone'] = null;
                    $contentsOfType[$contentIndex]['live_event_start_time'] = null;
                }
            }

            if (!empty($content->fetch('fields.live_event_end_time'))) {
                try {
                    $contentsOfType[$contentIndex]['live_event_end_time_in_timezone'] =
                        Carbon::parse($content->fetch('fields.live_event_end_time'), 'UTC')
                            ->timezone($timezone)->toDateTimeString();
                } catch (\Exception $exception) {
                    $contentsOfType[$contentIndex]['live_event_end_time_in_timezone'] = null;
                    $contentsOfType[$contentIndex]['live_event_end_time'] = null;
                }
            }
            if(isset($content['published_on'])) {
                $contentsOfType[$contentIndex]['published_on_in_timezone'] =
                    Carbon::parse($content['published_on'], 'UTC')
                        ->timezone($timezone)->toDateTimeString();
            }
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
