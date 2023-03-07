<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Transformers\PlaylistItemTransformer;

class UserPlaylistContentRepository extends RepositoryBase
{
    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return $this->connection()
            ->table(config('railcontent.table_prefix').'user_playlist_content');
    }

    /**
     * @param $playlistId
     * @param array $contentType
     * @param null $limit
     * @param int $page
     * @param string $sort
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getUserPlaylistContents(
        $playlistId,
        $contentType = [],
        $limit = null,
        $page = 1,
        $sort = "position"
    ) {
        $query =
            $this->query()
                ->select(
                    config('railcontent.table_prefix').'content.*',
                    config('railcontent.table_prefix').'user_playlist_content.start_second',
                    config('railcontent.table_prefix').'user_playlist_content.end_second',
                    config('railcontent.table_prefix').'user_playlist_content.position as user_playlist_item_position',
                    config('railcontent.table_prefix').'user_playlist_content.id as user_playlist_item_id',
                    config('railcontent.table_prefix').
                    'user_playlist_content.extra_data as user_playlist_item_extra_data'
                )
                ->join(
                    config('railcontent.table_prefix').'content',
                    config('railcontent.table_prefix').'user_playlist_content.content_id',
                    '=',
                    config('railcontent.table_prefix').'content.id'
                )
                ->where('user_playlist_id', $playlistId);
        if (!empty($contentType)) {
            $query->whereIn(config('railcontent.table_prefix').'content.type', $contentType);
        }

        if (is_array(ContentRepository::$availableContentStatues)) {
            $query->whereIn(
                config('railcontent.table_prefix').'content.status',
                ContentRepository::$availableContentStatues
            );
        }



        $orderByColumn = trim($sort, '-');
        if ($orderByColumn == 'random') {
            $query = $query->inRandomOrder();
            $limit = null;

        } else {
            $query = $query->orderBy(config('railcontent.table_prefix').'user_playlist_content.position', 'asc');
        }

        if ($limit) {
            $query->limit($limit)
                ->skip(($page - 1) * $limit);
        }

        $contentRows =
            $query->get()
                ->toArray();

        $extraData = $this->geExtraDataInOldStyle(['data', 'instructor', 'video'], $contentRows);

        $parser = $this->setPresenter(PlaylistItemTransformer::class);

        $parser->presenter->addParam($extraData);

        return $this->parserResult($contentRows);
    }

    /**
     * @param $playlistId
     * @param array $contentType
     * @return int
     */
    public function countUserPlaylistContents($playlistId, $contentType = [])
    {
        $query =
            $this->query()
                ->join(
                    config('railcontent.table_prefix').'content',
                    config('railcontent.table_prefix').'user_playlist_content.content_id',
                    '=',
                    config('railcontent.table_prefix').'content.id'
                )
                ->where('user_playlist_id', $playlistId);
        if (!empty($contentType)) {
            $query->whereIn(config('railcontent.table_prefix').'content.type', $contentType);
        }
        if (is_array(ContentRepository::$availableContentStatues)) {
            $query->whereIn(
                config('railcontent.table_prefix').'content.status',
                ContentRepository::$availableContentStatues
            );
        }

        return $query->count();
    }

    /**
     * @param $playlistId
     * @param $contentId
     * @return array|mixed[]
     */
    public function getByPlaylistIdAndContentId($playlistId, $contentId)
    {
        return $this->query()
            ->where('user_playlist_id', $playlistId)
            ->where('content_id', $contentId)
            ->get()
            ->toArray();
    }

    /**
     * returns: [
     *    content_id_1 => true/false,
     *    content_id_2 => true/false,
     *    etc...
     * ]
     *
     * @param array $contentIds
     * @param $playlistId
     * @return array
     */
    public function areContentIdsInPlaylist(array $contentIds, $playlistId)
    {
        $playlistContentIdLinkRows =
            $this->query()
                ->select(['content_id'])
                ->where('user_playlist_id', $playlistId)
                ->whereIn('content_id', $contentIds)
                ->get()
                ->pluck('content_id')
                ->toArray();

        $contentIdsInPlaylistBooleans = [];

        foreach ($contentIds as $contentId) {
            $contentIdsInPlaylistBooleans[$contentId] = in_array($contentId, $playlistContentIdLinkRows);
        }

        return $contentIdsInPlaylistBooleans;
    }

    /**
     * @param $playlistId
     * @return array|mixed[]
     */
    public function getByPlaylistId($playlistId)
    {
        return $this->query()
            ->where('user_playlist_id', $playlistId)
            ->get()
            ->toArray();
    }

    /**
     * @param null $dataId
     * @param $data
     * @return bool|int
     */
    public function createOrUpdatePlaylistContentAndReposition($dataId = null, $data)
    {
        $existingData =
            $this->query()
                ->where('id', $dataId)
                ->get()
                ->first();

        $userPlaylistId = $existingData['user_playlist_id'] ?? $data['user_playlist_id'];

        $dataCount =
            $this->query()
                ->where([
                            'user_playlist_id' => $userPlaylistId,
                        ])
                ->count();

        $data['position'] = $this->recalculatePosition(
            $data['position'] ?? $existingData['position'] ?? null,
            $dataCount,
            $existingData
        );

        if (empty($existingData)) {
            $this->incrementOtherPlaylistItemsPosition(
                null,
                $userPlaylistId,
                $data['position'],
                null
            );

            return $this->query()
                ->insertGetId($data);
        } elseif ($data['position'] > $existingData['position']) {
            $this->query()
                ->where('id', $dataId)
                ->update($data);

            return $this->decrementOtherPlaylistItemsPosition(
                $dataId,
                $userPlaylistId,
                $existingData['position'],
                $data['position']
            );
        } elseif ($data['position'] < $existingData['position']) {
            $updated =
                $this->query()
                    ->where('id', $dataId)
                    ->update($data);

            $this->incrementOtherPlaylistItemsPosition(
                $dataId,
                $userPlaylistId,
                $data['position'],
                $existingData['position']
            );

            return $updated;
        } else {
            return $this->query()
                ->where('id', $dataId)
                ->update($data);
        }
    }

    /**
     * @param null $excludedEntityId
     * @param $playlistId
     * @param $startPosition
     * @param null $endPosition
     * @return bool
     */
    private function incrementOtherPlaylistItemsPosition(
        $excludedEntityId = null,
        $playlistId,
        $startPosition,
        $endPosition = null
    ) {
        $query =
            $this->query()
                ->where('user_playlist_id', $playlistId)
                ->where('position', '>=', $startPosition);

        if ($excludedEntityId) {
            $query->where('id', '!=', $excludedEntityId);
        }

        if ($endPosition) {
            $query->where('position', '<', $endPosition);
        }

        return $query->increment('position') > 0;
    }

    /**
     * @param $excludedEntityId
     * @param $playlistId
     * @param $startPosition
     * @param $endPosition
     * @return bool
     */
    private function decrementOtherPlaylistItemsPosition(
        $excludedEntityId,
        $playlistId,
        $startPosition,
        $endPosition
    ) {
        return $this->query()
                ->where('user_playlist_id', $playlistId)
                ->where('id', '!=', $excludedEntityId)
                ->where('position', '>', $startPosition)
                ->where('position', '<=', $endPosition)
                ->decrement('position') > 0;
    }

    /**
     * @param $entity
     * @param string $positionColumnPrefix
     * @return bool
     */
    public function deletePlaylistItemAndReposition($entity, $positionColumnPrefix = '')
    {
        $existingLink =
            $this->query()
                ->where($entity)
                ->first();

        if (empty($existingLink)) {
            return true;
        }

        $query =
            $this->query()
                ->where('user_playlist_id', $existingLink['id']);

        $query->where(
            $positionColumnPrefix.'position',
            '>',
            $existingLink[$positionColumnPrefix."position"]
        )
            ->decrement($positionColumnPrefix.'position');

        $deleted =
            $this->query()
                ->where(['id' => $existingLink['id']])
                ->delete();

        return $deleted > 0;
    }

    /**
     * @param $playlistId
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getFirstContentByPlaylistId($playlistId)
    {
        return $this->query()
            ->where('user_playlist_id', $playlistId)
            ->first();
    }
}