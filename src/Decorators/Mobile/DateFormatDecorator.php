<?php

namespace Railroad\Railcontent\Decorators\Mobile;

use Carbon\Carbon;
use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Entities\CommentEntity;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Support\Collection;

class DateFormatDecorator implements DecoratorInterface
{
    public function decorate(Collection $contents)
    {
        try {
            foreach ($contents as $contentIndex => $content) {

                if ($content instanceof ContentEntity) {
                    $contents[$contentIndex]['published_on'] =
                        Carbon::parse($content['published_on'])
                            ->format('Y/m/d H:i:s');

                    foreach ($content['fields'] as $index => $field) {
                        if ($field['key'] === 'live_event_start_time') {
                            $contents[$contentIndex]['fields'][$index]['value'] =
                                Carbon::parse($field['value'])
                                    ->format('Y/m/d H:i:s');
                        }
                        if ($field['key'] === 'live_event_end_time') {
                            $contents[$contentIndex]['fields'][$index]['value'] =
                                Carbon::parse($field['value'])
                                    ->format('Y/m/d H:i:s');
                        }
                    }

                    if (isset($content['live_event_start_time_in_timezone'])) {
                        $contents[$contentIndex]['live_event_start_time_in_timezone'] =
                            Carbon::parse($content['live_event_start_time_in_timezone'])
                                ->format('Y/m/d H:i:s');
                    }
                    if (isset($content['live_event_end_time_in_timezone'])) {
                        $contents[$contentIndex]['live_event_end_time_in_timezone'] =
                            Carbon::parse($content['live_event_end_time_in_timezone'])
                                ->format('Y/m/d H:i:s');
                    }
                    if (isset($content['published_on_in_timezone'])) {
                        $contents[$contentIndex]['published_on_in_timezone'] =
                            Carbon::parse($content['published_on_in_timezone'])
                                ->format('Y/m/d H:i:s');
                    }
                }

                if ($content instanceof CommentEntity) {
                    $contents[$contentIndex]['created_on'] =
                        Carbon::parse($content['created_on'])
                            ->format('Y/m/d H:i:s');
                    $replies = $contents[$contentIndex]['replies'] ?? [];
                    foreach ($replies as $index => $reply) {
                        $contents[$contentIndex]['replies'][$index]['created_on'] =
                            Carbon::parse($contents[$contentIndex]['replies'][$index]['created_on'])
                                ->format('Y/m/d H:i:s');
                    }

                }
            }
        } catch (Exception $exception) {

        }

        return $contents;
    }
}