<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Repositories\Traits\ByContentIdTrait;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Resora\Decorators\Decorator;
use Railroad\Resora\Queries\CachedQuery;

class ContentDatumRepository extends \Railroad\Resora\Repositories\RepositoryBase
{
    use ByContentIdTrait;
    /**
     * @return CachedQuery|$this
     */
    protected function newQuery()
    {
        return (new CachedQuery($this->connection()))->from(ConfigService::$tableContentData);
    }

//    protected function decorate($results)
//    {
//        /* if(!($results instanceof Product))
//         {
//             $results = new Product($results);
//         } */
//
//        return Decorator::decorate($results, 'content-data');
//    }
//    use ByContentIdTrait;
//
//    /**
//     * @return Builder
//     */
//    public function query()
//    {
//        return $this->connection()->table(ConfigService::$tableContentData);
//    }
//
//    /**
//     * @param integer $contentId
//     * @return array
//     */
//    public function getByContentId($contentId)
//    {
//        if (empty($contentId)) {
//            return [];
//        }
//
//        return $this->query()
//            ->where('content_id', $contentId)
//            ->orderBy('position', 'asc')
//            ->get()
//            ->toArray();
//    }
//
//    /**
//     * @param array $contentIds
//     * @return array
//     */
//    public function getByContentIds(array $contentIds)
//    {
//        if (empty($contentIds)) {
//            return [];
//        }
//
//        return $this->query()
//            ->whereIn('content_id', $contentIds)
//            ->orderBy('position', 'asc')
//            ->get()
//            ->toArray();
//    }
}