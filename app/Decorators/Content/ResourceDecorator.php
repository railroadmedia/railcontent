<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Support\Collection;

class ResourceDecorator extends ModeDecoratorBase
{
    public function decorate(Collection $contents)
    {
        if (self::$decorationMode !== self::DECORATION_MODE_MAXIMUM) {
            return $contents;
        }

        foreach ($contents as $contentIndex => $content) {
            foreach ($content['data'] ?? [] as $resource) {

                if ($resource['key'] === 'resource_name') {
                    $contents[$contentIndex]['resources'][$resource['position']]['resource_id'] = $resource['id'];
                    $contents[$contentIndex]['resources'][$resource['position']]['resource_name'] = $resource['value'];
                }

                if ($resource['key'] === 'resource_url') {
                    if(str_starts_with($resource['value'], '//')) {
                        $resource['value'] = 'https:' . $resource['value'];
                    }
                    $contents[$contentIndex]['resources'][$resource['position']]['resource_url'] = $resource['value'];
                }
            }

            foreach ($contents[$contentIndex]['resources']  ?? [] as $setResourcePosition => $setResource) {
                if (!isset($contents[$contentIndex]['resources'][$setResourcePosition]['resource_name']) ||
                    !isset($contents[$contentIndex]['resources'][$setResourcePosition]['resource_url'])) {
                    unset($contents[$contentIndex]['resources'][$setResourcePosition]);
                }
            }
        }

        return $contents;
    }
}
