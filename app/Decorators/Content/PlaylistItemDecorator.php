<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Support\Collection;

class PlaylistItemDecorator extends TypeDecoratorBase
{
    /**
     * @param Collection $contents
     * @return mixed|Collection
     */
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->whereNotNull('user_playlist_item_id');

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        foreach ($contentsOfType as $contentIndex => $content) {
            //set start/end time should not be displayed on assignments and song playlist items
            $contentsOfType[$contentIndex]['set_start_end_time'] = ($content['type'] != 'assignment');
            $contentsOfType[$contentIndex]['user_playlist_item_extra_data'] = $content['user_playlist_item_extra_data'] ?? null;
            if (!empty($content['user_playlist_item_extra_data'])) {
                foreach (json_decode($content['user_playlist_item_extra_data'], true) as $key => $value) {
                    $contentsOfType[$contentIndex][$key] = $value;
                }
            }

            //thumbnail_url
            $contentsOfType[$contentIndex]['thumbnail_url'] = $content->fetch('data.original_thumbnail_url');

            $route = [];

            if (!empty($content['parent_content_data'])) {
                $parentContentData = array_reverse(json_decode($content['parent_content_data'], true));
                $parentIds = \Arr::pluck($parentContentData, 'id');
                $parents =
                    $this->contentService->getByIds($parentIds)
                        ->keyBy('id');

                foreach ($parentContentData as $value) {
                    if ((isset($parents[$value['id']]))) {
                        $parentTitle = $parents[$value['id']]['title'];
                        if ($content['type'] == 'assignment') {
                            $contentsOfType[$contentIndex]['fields'] =
                                array_merge($content['fields'], $parents[$value['id']]['fields'] ?? []);
//                            $contentsOfType[$contentIndex]['data'] =
//                                array_merge($content['data'], $parents[$value['id']]['data'] ?? []);
                            $contentsOfType[$contentIndex]['thumbnail_url'] = $parents[$value['id']]->fetch('data.original_thumbnail_url');
                        }
                    }
                    switch ($value['type']) {
                        case 'learning-path':
                            $route[] = 'Method';
                            break;
                        case 'learning-path-level':
                            $route[] = 'L'.$value['position'];
                            break;
                        case 'song':
                            break;
                        case 'play-along':
                            break;
                        default:
                            $route[] = $parentTitle ?? '';
                            break;
                    }
                }
                $contentsOfType[$contentIndex]['parent'] = (isset($parents[$value['id']])) ? $parents[$value['id']] : null;

                if(empty($contentsOfType[$contentIndex]['instructors'])){
                    $contentsOfType[$contentIndex]['instructors'] += $parents[$value['id']]['instructors'];
                }
            }
            $contentsOfType[$contentIndex]['route'] = $route;
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
