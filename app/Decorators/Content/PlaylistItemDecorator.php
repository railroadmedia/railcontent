<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Support\Collection;

class PlaylistItemDecorator extends TypeDecoratorBase
{
    private static $parents = [];


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
            $contentsOfType[$contentIndex]['thumbnail_url'] = $content->fetch('data.original_thumbnail_url',  $content->fetch('data.thumbnail_url'));

            $route = [];

            if (!empty($content['parent_content_data'])) {
                $parentContentData = array_reverse(json_decode($content['parent_content_data'], true));
                foreach ($parentContentData as $value) {
                    if ((isset(self::$parents[$value['id']]))) {
                        if ($content['type'] == 'assignment') {
                            $contentsOfType[$contentIndex]['fields'] =
                                array_merge($content['fields'], self::$parents[$value['id']]['fields'] ?? []);
//                            $contentsOfType[$contentIndex]['data'] =
//                                array_merge($content['data'], $parents[$value['id']]['data'] ?? []);
                            $contentsOfType[$contentIndex]['thumbnail_url'] = self::$parents[$value['id']]->fetch('data.original_thumbnail_url');
                        }
                    }else{
                        $parentIds = \Arr::pluck($parentContentData, 'id');
                        Decorator::$typeDecoratorsEnabled = false;
                        self::$parents += $this->contentService->getByIds($parentIds)->keyBy('id')->toArray();
                        Decorator::$typeDecoratorsEnabled = true;
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
                        case 'edge-pack':
                            break;
                        default:
                            $route[] = self::$parents[$value['id']]['title'] ?? '';
                            break;
                    }
                }
                $contentsOfType[$contentIndex]['parent'] = (isset(self::$parents[$value['id']])) ? self::$parents[$value['id']] : null;

                if(empty($contentsOfType[$contentIndex]['instructors'])){
//                    \Railroad\Railcontent\Decorators\ModeDecoratorBase::DECORATION_MODE_MINIMUM;
//                    $this->instructorDecorator->decorate(new Collection(self::$parents[$value['id']]));
                    $contentsOfType[$contentIndex]['instructors'] += self::$parents[$value['id']]['instructors'] ?? [];
                }
            }
            $contentsOfType[$contentIndex]['route'] = $route;
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
