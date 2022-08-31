<?php

namespace App\Decorators\Content;

use App\Maps\PrimaryURLSlugToContentTypeMap;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Support\Collection;

class UrlDecorator extends ModeDecoratorBase
{
    /**
     * @param  Collection|ContentEntity[]  $contents
     * @return array|Collection
     */
    public function decorate(Collection $contents)
    {
        if ($contents->isEmpty()) {
            return $contents;
        }

        // set url based on type
        foreach ($contents as $contentIndex => $content) {
            /**
             * @var $content ContentEntity
             */

            $contentTypeToURLSlugMap = array_flip(PrimaryURLSlugToContentTypeMap::$map);
            $contentParentData = $content->getParentContentData();

            //TODO: Should be deleted when the hierarchy with the draft learning-path: advanced-lead-guitar is deleted
            if(brand() == 'guitareo' && $content['type'] == 'play-along'){
                $contentParentData = [];
            }

            // first-level types
            if (count($contentParentData) == 0 &&
                !empty($contentTypeToURLSlugMap[$content['type']])) {
                $contents[$contentIndex]['url'] =
                    url()->route(
                        'platform.content.first-level',
                        [
                            'brand' => $content['brand'],
                            $contentTypeToURLSlugMap[$content['type']],
                            $content['slug'],
                            $content['id'],
                        ]
                    );
            }

            // second-level types
            if (count($contentParentData) == 1 &&
                !empty($contentTypeToURLSlugMap[$contentParentData[0]->type])) {
                $contents[$contentIndex]['url'] =
                    url()->route(
                        'platform.content.second-level',
                        [
                            'brand' => $content['brand'],
                            $contentTypeToURLSlugMap[$contentParentData[0]->type],
                            $contentParentData[0]->slug,
                            $contentParentData[0]->id,
                            $content['slug'],
                            $content['id'],
                        ]
                    );
            }

            // third-level types
            if (count($contentParentData) == 2 &&
                !empty($contentTypeToURLSlugMap[$contentParentData[1]->type])) {
                $contents[$contentIndex]['url'] = url()->route(
                    'platform.content.third-level',
                    [
                        'brand' => $content['brand'],
                        $contentTypeToURLSlugMap[$contentParentData[1]->type],
                        $contentParentData[1]->slug,
                        $contentParentData[1]->id,
                        $contentParentData[0]->slug,
                        $contentParentData[0]->id,
                        $content['slug'],
                        $content['id'],
                    ]
                );
            }

            // fourth-level types
            if (count($contentParentData) == 3 &&
                !empty($contentTypeToURLSlugMap[$contentParentData[2]->type])) {
                $contents[$contentIndex]['url'] = url()->route(
                    'platform.content.fourth-level',
                    [
                        'brand' => $content['brand'],
                        $contentTypeToURLSlugMap[$contentParentData[2]->type],
                        $contentParentData[2]->slug,
                        $contentParentData[2]->id,
                        $contentParentData[1]->slug,
                        $contentParentData[1]->id,
                        $contentParentData[0]->slug,
                        $contentParentData[0]->id,
                        $content['slug'],
                        $content['id'],
                    ]
                );
            }
        }

        return $contents;
    }
}
