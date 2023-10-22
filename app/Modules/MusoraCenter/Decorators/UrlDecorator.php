<?php

namespace App\Modules\MusoraCenter\Decorators;

use App\Maps\PrimaryURLSlugToContentTypeMap;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Repositories\RepositoryBase;
use Railroad\Railcontent\Support\Collection;

class UrlDecorator
{
    /**
     * @param Collection|ContentEntity[] $contents
     * @return array|Collection
     */
    public function decorate(Collection $contents)
    {
        if ($contents->isEmpty() || !str_contains(request()->path(), 'musora-center')) {
            return $contents;
        }

        $contentIds = [];

        foreach ($contents as $content) {
            $contentIds[] = $content['id'];
        }

        $contentRows = RepositoryBase::$publicConnectionMask
            ->table('railcontent_content')
            ->whereIn('id', $contentIds)
            ->get()
            ->keyBy('id');

        // set url based on type
        foreach ($contents as $contentIndex => $content) {
            /**
             * @var $content ContentEntity
             */

            $contentRow = $contentRows[$content['id']] ?? null;

            if (empty($contentRow)) {
                continue;
            }

            $contentTypeToURLSlugMap = array_flip(PrimaryURLSlugToContentTypeMap::$map);
            $contentParentData = json_decode($contentRow['parent_content_data']);

            if (empty($contentParentData)) {
                $contentParentData = [];
            }

            //TODO: Should be deleted when the hierarchy with the draft learning-path: advanced-lead-guitar is deleted
            if ($content['brand'] == 'guitareo' && $content['type'] == 'play-along') {
                $contentParentData = [];
            }

            if (app()->environment() == 'development' || app()->environment() == 'local') {
                $domain = 'https://dev.musora.com:8443/';
            } elseif (app()->environment() == 'staging') {
                $domain = 'https://beta-testing.musora.com/';
            } else {
                $domain = 'https://www.musora.com/';
            }

            // first-level types
            if (count($contentParentData) == 0 &&
                !empty($contentTypeToURLSlugMap[$content['type']])) {
                $contents[$contentIndex]['url'] = $domain .
                    $content['brand'] . '/' .
                    $contentTypeToURLSlugMap[$content['type']] . '/' .
                    $content['slug'] . '/' .
                    $content['id'];
            }

            // second-level types
            if (count($contentParentData) == 1 &&
                !empty($contentTypeToURLSlugMap[$contentParentData[0]->type])) {
                $contents[$contentIndex]['url'] = $domain .
                    $content['brand'] . '/' .
                    $contentTypeToURLSlugMap[$contentParentData[0]->type] . '/' .
                    $contentParentData[0]->slug . '/' .
                    $contentParentData[0]->id . '/' .
                    $content['slug'] . '/' .
                    $content['id'];
            }

            // third-level types
            if (count($contentParentData) == 2 &&
                !empty($contentTypeToURLSlugMap[$contentParentData[1]->type])) {
                $contents[$contentIndex]['url'] = $domain .
                    $content['brand'] . '/' .
                    $contentTypeToURLSlugMap[$contentParentData[1]->type] . '/' .
                    $contentParentData[1]->slug . '/' .
                    $contentParentData[1]->id . '/' .
                    $contentParentData[0]->slug . '/' .
                    $contentParentData[0]->id . '/' .
                    $content['slug'] . '/' .
                    $content['id'];
            }

            // fourth-level types
            if (count($contentParentData) == 3 &&
                !empty($contentTypeToURLSlugMap[$contentParentData[2]->type])) {
                $contents[$contentIndex]['url'] = $domain .
                    $content['brand'] . '/' .
                    $contentTypeToURLSlugMap[$contentParentData[2]->type] . '/' .
                    $contentParentData[2]->slug . '/' .
                    $contentParentData[2]->id . '/' .
                    $contentParentData[1]->slug . '/' .
                    $contentParentData[1]->id . '/' .
                    $contentParentData[0]->slug . '/' .
                    $contentParentData[0]->id . '/' .
                    $content['slug'] . '/' .
                    $content['id'];
            }
        }

        return $contents;
    }
}
