<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Services\ConfigService;

/**
 * Class ContentPermissionRepository
 *
 * @package Railroad\Railcontent\Repositories
 */
class ContentPermissionRepository extends RepositoryBase
{
    /**
     * This tells the query to only pull content that has its required permissions satisfied by these ids.
     *
     * If false, content permissions are ignored.
     * If an array, only content with those permissions are returned.
     *
     * @var bool|array
     */
    public static $availableContentPermissionIds = false;

    /**
     * Return a permission based on it's id
     *
     * @param integer $id
     * @return array|null
     */
    public function getById($id)
    {
        return $this->query()
            ->join(
                ConfigService::$tablePermissions,
                ConfigService::$tablePermissions . '.id',
                '=',
                ConfigService::$tableContentPermissions . '.permission_id'
            )
            ->where(ConfigService::$tablePermissions . '.id', $id)
            ->first();
    }

    /**
     * @param array $contentIds
     * @return array
     */
    public function getByContentIds(array $contentIds)
    {
        return $this->query()
            ->join(
                ConfigService::$tablePermissions,
                ConfigService::$tablePermissions . '.id',
                '=',
                ConfigService::$tableContentPermissions . '.permission_id'
            )
            ->whereIn(ConfigService::$tableContentPermissions . '.id', $contentIds)
            ->get()
            ->toArray();
    }

    /**
     * Create a new record in railcontent_content_permission with the permission id and the specific content($contentId) or the content type
     *
     * @param integer|null $contentId
     * @param string|null $contentType
     * @param integer $permissionId
     * @return integer
     */
    public function assign($contentId = null, $contentType = null, $permissionId)
    {
        $contentPermissionId = $this->query()->insert(
            [
                'content_id' => $contentId,
                'content_type' => $contentType,
                'permission_id' => $permissionId
            ]
        );

        return $contentPermissionId;
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return parent::connection()->table(ConfigService::$tableContentPermissions);
    }

}