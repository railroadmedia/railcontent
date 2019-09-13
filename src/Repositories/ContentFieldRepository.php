<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Repositories\Traits\ByContentIdTrait;
use Railroad\Railcontent\Services\ConfigService;

class ContentFieldRepository extends RepositoryBase
{
    use ByContentIdTrait;

    /**
     * @return Builder
     */
    public function query()
    {
        return $this->connection()->table(ConfigService::$tableContentFields);
    }

    /**
     * @param integer $contentId
     * @return array
     */
    public function getByContentId($contentId)
    {
        if (empty($contentId)) {
            return [];
        }
        
        return $this->query()
            ->where('content_id', $contentId)
            ->orderBy('position', 'asc')
            ->get()
            ->toArray();
    }

    /**
     * @param array $contentIds
     * @return array
     */
    public function getByContentIds(array $contentIds)
    {
        if (empty($contentIds)) {
            return [];
        }
        
        return $this->query()
            ->whereIn('content_id', array_unique($contentIds))
            ->orderBy('position', 'asc')
            ->get()
            ->toArray();
    }

    public function attachLinkedContents(array $fieldRows)
    {
        $contentIdsToGrab = [];

        foreach ($fieldRows as $fieldRow) {
            if ($fieldRow['type'] === 'content_id') {
                $contentIdsToGrab[] = $fieldRow['valye'];
            }
        }

        $contentIdsToGrab = array_unique($contentIdsToGrab);

        $subContents = $this->query()
            ->select(
                [
                    ConfigService::$tableContentFields . '.type as field_type',
                    ConfigService::$tableContentFields . '.value as field_value',
                    ConfigService::$tableContentFields . '.content_id'
                ]
            )
            ->join(
                ConfigService::$tableContent,
                ConfigService::$tableContent . '.id',
                '=',
                ConfigService::$tableContentFields . '.content_id'
            )
            ->where([ConfigService::$tableContentFields . '.type' => 'content_id'])
            ->whereIn(ConfigService::$tableContent . '.id',
                array_column($fieldRows,
                    'value'))
            ->get()
            ->keyBy('content_id')
            ->toArray();

        var_dump($fieldRows);

//        foreach ($fieldRows as $rowIndex => $fieldRow) {
//            if ($fieldRow['type'] === 'content_id') {
//                $fieldRows[$rowIndex]['value'] = $subContents[$fieldRow['value']];
//            }
//        }

        dd($subContents);
    }
}