<?php

namespace Railroad\Railcontent\Decorators\Content;

use Railroad\Railcontent\Repositories\ContentPermissionRepository;
use Railroad\Resora\Decorators\DecoratorInterface;

class ContentChildsAndParentsDecorator implements DecoratorInterface
{
    public function decorate($contents)
    {
        foreach ($contents as $index => $content) {
            if (!empty($content['child_id'])) {
                $contents[$index]['child_ids'][] = $content['child_id'];
            }
            if (!empty($content['parent_id'])) {
                $contents[$index]['parent_id'] = $content['parent_id'];
                $contents[$index]['position'] = $content['child_position'] ?? null;
                unset($contents[$index]['child_position']);
            }
        }
        return $contents;
    }
}