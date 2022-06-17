<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Repositories\Traits\ByContentIdTrait;
use Railroad\Railcontent\Services\ConfigService;

class ContentFollowsRepository extends RepositoryBase
{
    use ByContentIdTrait;

    private $cache = [];

    public function query()
    {
        return parent::connection()
            ->table(ConfigService::$tableContentFollows);
    }

    /**
     * @param $userId
     * @param $brand
     * @param null $contentType
     * @return array
     */
    public function getFollowedContent($userId, $brand, $contentType = null, $page, $limit)
    {
        if ($limit == 'null') {
            $limit = -1;
        }

        $query =
            $this->query()
                ->select('*')
                ->leftJoin(
                    ConfigService::$tableContent,
                    'content_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                )
                ->where(ConfigService::$tableContentFollows . '.user_id', $userId)
                ->where(ConfigService::$tableContent . '.brand', $brand);

        if ($contentType) {
            $query->where(ConfigService::$tableContent . '.type', $contentType);
        }

        if ($limit >= 1) {
            $query->limit($limit)
                ->skip(($page - 1) * $limit);
        }

        $rows = $query->orderBy(ConfigService::$tableContentFollows . '.created_on', 'desc')
            ->get()
            ->toArray();

        // remove duplicate rows
        $rowsWithoutDuplicates = [];

        foreach ($rows as $row) {
            $rowsWithoutDuplicates[$row['content_id']] = $row;
        }

        return $rowsWithoutDuplicates;
    }

    /**
     * @param $userId
     * @param $brand
     * @param null $contentType
     * @return int
     */
    public function countFollowedContent($userId, $brand, $contentType = null)
    {
        $query =
            $this->query()
                ->leftJoin(
                    ConfigService::$tableContent,
                    'content_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                )
                ->where(ConfigService::$tableContentFollows . '.user_id', $userId)
                ->where(ConfigService::$tableContent . '.brand', $brand);

        if ($contentType) {
            $query->where(ConfigService::$tableContent . '.type', $contentType);
        }

        return $query->count();
    }

    /**
     * @param string|null $brand
     * @return array|mixed|mixed[]
     */
    public function getFollowedContentIds(?string $brand = null)
    {
        if (!isset($this->cache[auth()->id()])) {
            $query = $this->query()
                ->select(ConfigService::$tableContentFollows . '.content_id')
                ->join(
                    ConfigService::$tableContent,
                    ConfigService::$tableContentFollows . '.content_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                )
                ->where([
                    ConfigService::$tableContentFollows . '.user_id' => auth()->id()
                ]);
            if($brand){
                $query->where('brand', $brand);
            }
            $contents = $query->get();
            $this->cache[auth()->id()] = $contents->pluck('content_id')->toArray();
        }

        return $this->cache[auth()->id()];
    }

}
