<?php

namespace App\Decorators\Playlist;

use App\Decorators\Content\AddedToPrimaryPlaylistDecorator;
use App\Decorators\Content\TypeDecoratorBase;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Support\Collection;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Repositories\PinnedPlaylistsRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPlaylistsService;

class RoutingDecorator extends TypeDecoratorBase
{

    private static $parents = [];

    /**
     * @param Collection $contents
     * @return mixed|Collection
     */
    public function decorate($contents)
    {
       if (empty($contents)) {
            return $contents;
        }

        foreach ($contents as $contentIndex => $content) {
            $route = [];

            if (!empty($content['parent_content_data'])) {
                $parentContentData = array_reverse(json_decode($content['parent_content_data'], true));
                foreach ($parentContentData as $value) {
                    if ((!isset(self::$parents[$value['id']]))) {
                        $parentIds = \Arr::pluck($parentContentData, 'id');
                        Decorator::$typeDecoratorsEnabled = false;
                        self::$parents = $this->contentService->getByIds($parentIds)->keyBy('id')->toArray() + self::$parents;
                        //  dd(self::$parents);
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
                $contents[$contentIndex]['parent'] = (isset(self::$parents[$value['id']])) ? self::$parents[$value['id']] : null;

                if(empty($contents[$contentIndex]['instructors'])){
                    \Railroad\Railcontent\Decorators\ModeDecoratorBase::$decorationMode = \Railroad\Railcontent\Decorators\ModeDecoratorBase::DECORATION_MODE_MINIMUM;

                    $this->instructorDecorator->decorate(new Collection(self::$parents));
                    $contents[$contentIndex]['instructors'] += self::$parents[$value['id']]['instructors'] ?? [];
                }
            }
            $contents[$contentIndex]['route'] = $route;
        }

        return $contents;
    }
}
