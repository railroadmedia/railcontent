<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Events\ElasticDataShouldUpdate;
use Railroad\Railcontent\Repositories\Traits\ByContentIdTrait;
use Railroad\Railcontent\Services\ConfigService;

/**
 * Class ContentPermissionRepository
 *
 * @package Railroad\Railcontent\Repositories
 */
class ContentPermissionRepository extends RepositoryBase
{
    use ByContentIdTrait;

    /**
     * @return Builder
     */
    public function query()
    {
        return parent::connection()->table(ConfigService::$tableContentPermissions);
    }

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
            ->where(ConfigService::$tablePermissions . '.brand', ConfigService::$brand)
            ->first();
    }

    /**
     * @param array $contentIds
     * @param array $contentTypes
     * @return array
     */
    public function getByContentIdsOrTypes(array $contentIds, array $contentTypes)
    {
        if (empty($contentIds) && empty($contentTypes)) {
            return [];
        }

        return $this->query()
            ->join(
                ConfigService::$tablePermissions,
                ConfigService::$tablePermissions . '.id',
                '=',
                ConfigService::$tableContentPermissions . '.permission_id'
            )
            ->orWhereIn(ConfigService::$tableContentPermissions . '.content_id', array_unique($contentIds))
            ->orWhereIn(ConfigService::$tableContentPermissions . '.content_type', array_unique($contentTypes))
            ->where(ConfigService::$tablePermissions . '.brand', ConfigService::$brand)
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

        event(new ElasticDataShouldUpdate($contentId));

        return $contentPermissionId;
    }

    /**
     * Unlink content permission links
     *
     * @param integer $permissionId
     * @return bool
     */
    public function unlinkPermissionFromAllContent($permissionId)
    {
        return $this->query()->where('permission_id', $permissionId)->delete() > 0;
    }

    public function dissociate($contentId = null, $contentType = null, $permissionId)
    {
        return $this->query()->where(
            [
                'content_id' => $contentId,
                'content_type' => $contentType,
                'permission_id' => $permissionId
            ]
        )->delete();
    }

    /**
     * Return all the contents associated with the permission id
     *
     * @param integer $id
     * @return array|null
     */
    public function getContentAssociationBasedOnPermissionId($id)
    {
        return $this->query()
            ->join(
                ConfigService::$tablePermissions,
                ConfigService::$tablePermissions . '.id',
                '=',
                ConfigService::$tableContentPermissions . '.permission_id'
            )
            ->where(ConfigService::$tablePermissions . '.id', $id)
            ->where(ConfigService::$tablePermissions . '.brand', ConfigService::$brand)
            ->get()
            ->toArray();
    }

}