<?php

namespace App\Decorators\Content;

use App\Maps\PrimaryURLSlugToContentTypeMap;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Support\Collection;

class UrlDecorator extends ModeDecoratorBase
{
    /**
     * @param Collection|ContentEntity[] $contents
     * @return array|Collection
     */
    public function decorate(Collection|\Illuminate\Support\Collection $contents)
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
            $contentParentData = json_decode($content['parent_content_data'] ?? '') ?? [];
                //$content->getParentContentData();

            if(count($contentParentData) == 1 && $contentParentData[0]->type == 'edge-pack') {
                $contentParentData = [];
            }

            if ($content['type'] == 'coach-stream') {
                $contents[$contentIndex]['url'] = url()->route('platform.coach.first-level', [
                    'brand' => $content['brand'],
                    $content->fetch(
                        'fields.instructor.1.slug'
                    ),
                    $content['slug'],
                    $content['id'],
                ]);
            }

            //TODO: Should be deleted when the hierarchy with the draft learning-path: advanced-lead-guitar is deleted
            if ((brand() == 'guitareo' && $content['type'] == 'play-along') ||
                ($content['type'] == 'course') ||
                (($content['type'] ==  'song') && (brand() == 'guitareo'))) {

                $contentParentData = [];
            }
            if(($content['type'] == 'course-part') && count($contentParentData) > 1) {
                $contentParentData = array_slice($contentParentData, 0, 1);
            }

            // first-level types
            if ($content['type'] == 'song-tutorial' ||
                $content['type'] == 'quick-tips' ||
                $content['type'] == 'student-review' ||
                $content['type'] == 'challenge' ||
                (count($contentParentData) == 0 && !empty($contentTypeToURLSlugMap[$content['type']]))) {
                $contents[$contentIndex]['url'] = url()->route('platform.content.first-level', [
                    'brand' => $content['brand'],
                    $contentTypeToURLSlugMap[$content['type']],
                    $content['slug'],
                    $content['id'],
                ]);
                // second-level types
            } elseif (count($contentParentData) == 1 && !empty($contentTypeToURLSlugMap[$contentParentData[0]->type])) {
                $contents[$contentIndex]['url'] = url()->route('platform.content.second-level', [
                    'brand' => $content['brand'],
                    $contentTypeToURLSlugMap[$contentParentData[0]->type],
                    $contentParentData[0]->slug,
                    $contentParentData[0]->id,
                    $content['slug'],
                    $content['id'],
                ]);
                // third-level types
            } elseif (count($contentParentData) == 2 && !empty($contentTypeToURLSlugMap[$contentParentData[1]->type])) {
                $contents[$contentIndex]['url'] = url()->route('platform.content.third-level', [
                    'brand' => $content['brand'],
                    $contentTypeToURLSlugMap[$contentParentData[1]->type],
                    $contentParentData[1]->slug,
                    $contentParentData[1]->id,
                    $contentParentData[0]->slug,
                    $contentParentData[0]->id,
                    $content['slug'],
                    $content['id'],
                ]);
                // fourth-level types
            } elseif (count($contentParentData) == 3 && !empty($contentTypeToURLSlugMap[$contentParentData[2]->type])) {
                $contents[$contentIndex]['url'] = url()->route('platform.content.fourth-level', [
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
                ]);
            }
        }

        return $contents;
    }
}
