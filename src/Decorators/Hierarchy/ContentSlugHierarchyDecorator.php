<?php

namespace Railroad\Railcontent\Decorators\Hierarchy;

use Illuminate\Database\Query\JoinClause;
use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Repositories\RepositoryBase;
use Railroad\Railcontent\Services\ConfigService;

class ContentSlugHierarchyDecorator implements DecoratorInterface
{
    public function decorate($contentResults)
    {
        $query = RepositoryBase::$connectionMask->table(ConfigService::$tableContent . ' as parent_content_0')
            ->whereIn('parent_content_0.id', array_column($contentResults, 'id'));

        for ($i = 0; $i < ConfigService::$contentHierarchyMaxDepth; $i++) {

            $query->leftJoin(
                ConfigService::$tableContentHierarchy . ' as content_hierarchy_' . $i,
                'content_hierarchy_' . $i . '.child_id',
                '=',
                'parent_content_' . $i . '.id'
            )
                ->leftJoin(
                    ConfigService::$tableContent . ' as parent_content_' . ($i + 1),
                    function (JoinClause $join) use ($i) {

                        $join->on(
                            'parent_content_' . ($i + 1) . '.id',
                            '=',
                            'content_hierarchy_' . $i . '.parent_id'
                        )
                            ->whereIn(
                                'parent_content_' . ($i + 1) . '.type',
                                [ConfigService::$contentHierarchyDecoratorAllowedTypes]
                            );
                    }
                )
                ->addSelect('parent_content_0.id as id')
                ->addSelect('parent_content_' . ($i + 1) . '.id as parent_content_' . ($i + 1) . '.id')
                ->addSelect('parent_content_' . ($i + 1) . '.slug as parent_content_' . ($i + 1) . '.slug')
                ->addSelect('parent_content_' . ($i + 1) . '.type as parent_content_' . ($i + 1) . '.type');
        }

        $slugHierarchies = $query->get();

        foreach ($contentResults as $contentIndex => $content) {
            foreach ($slugHierarchies as $slugHierarchy) {

                for ($i = 1; $i < ConfigService::$contentHierarchyMaxDepth; $i++) {

                    if ($slugHierarchy['id'] == $content['id'] &&
                        !empty($slugHierarchy['parent_content_' . ($i) . '.slug'])) {

                        $contentResults
                        [$contentIndex]
                        ['parent_slug_hierarchy']
                        [$slugHierarchy['parent_content_' . ($i) . '.type']][] =
                            $slugHierarchy['parent_content_' . ($i) . '.slug'];
                    }
                }
            }
        }

        return $contentResults;
    }
}