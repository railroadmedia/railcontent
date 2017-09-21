<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 9/14/2017
 * Time: 4:37 PM
 */

namespace Railroad\Railcontent\Repositories;


use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\SearchInterface;
use Railroad\Railcontent\Services\UserContentService;

class UserContentRepository extends RepositoryBase implements SearchInterface
{
    protected $search;

    /**
     * UserContentRepository constructor.
     * @param $searchService
     */
    public function __construct(SearchInterface $searchService)
    {
        $this->search = $searchService;

    }

    /**
     * Return a record from railcontent_user_content table based on content_id and user_id
     *
     * @param int $contentId
     * @param int $userId
     * @return array
     */
    public function getUserContent($contentId, $userId)
    {
        return $this->queryTable()->where(['content_id' => $contentId,
            'user_id' => $userId])->get()->first();
    }

    /**
     * Insert a new record in railcontent_user_content table and return the id
     * @param int $contentId
     * @param int $userId
     * @param string $state
     * @return int
     */
    public function saveUserContent($contentId, $userId, $state)
    {
        $userContentId = $this->queryTable()->insertGetId(
            [
                'content_id' => $contentId,
                'user_id' => $userId,
                'state' => $state,
                'progress' => 0
            ]
        );

        return $userContentId;
    }

    /**
     * Update a record from railcontent_user_content table with the params, based on content_id and user_id
     * @param int $contentId
     * @param int $userId
     * @param array $data
     * @return int
     */
    public function updateUserContent($contentId, $userId, $data)
    {
        $userContentId = $this->queryTable()->where(['content_id' => $contentId,
            'user_id' => $userId])->update($data);

        return $userContentId;
    }

    public function queryTable()
    {
        return parent::connection()->table(ConfigService::$tableUserContent);
    }

    /**
     * @return mixed
     */
    public function generateQuery()
    {
        $queryBuilder = $this->search->generateQuery();

        $userId = $this->getAuthenticatedUserId(request());

        $state = (request()->exists('only_completed')) ? UserContentService::STATE_COMPLETED : (request()->exists('only_started')) ? UserContentService::STATE_STARTED : null;
        $playlists = request()->playlists ?? [];

        if($state) {
            $this->generateUserContentQuery($queryBuilder, $userId);

            $queryBuilder->where(ConfigService::$tableUserContent.'.state', '=', $state);
        }

        if(request()->exists('playlists')) {
            if(!$state) {
                $this->generateUserContentQuery($queryBuilder, $userId);
            }

            $this->generateUserPlaylistsQuery($queryBuilder);

            $queryBuilder->whereIn(ConfigService::$tablePlaylists.'.name', $playlists);
        }

        return $queryBuilder;
    }

    /**
     * @param $queryBuilder
     */
    private function generateUserContentQuery($queryBuilder, $userId)
    {
        //join with user content
        $queryBuilder->leftJoin(
            ConfigService::$tableUserContent,
            ConfigService::$tableUserContent.'.content_id',
            '=',
            ConfigService::$tableContent.'.id'
        )->where(ConfigService::$tableUserContent.'.user_id', '=', $userId);
    }

    /**
     * @param $queryBuilder
     */
    private function generateUserPlaylistsQuery($queryBuilder)
    {
        $queryBuilder->leftJoin(
            ConfigService::$tableUserContentPlaylists,
            ConfigService::$tableUserContent.'.id',
            '=',
            ConfigService::$tableUserContentPlaylists.'.content_user_id'
        )->leftJoin(
            ConfigService::$tablePlaylists,
            ConfigService::$tablePlaylists.'.id',
            '=',
            ConfigService::$tableUserContentPlaylists.'.playlist_id'
        );
    }
}