<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Railroad\Railcontent\Services\ConfigService;

/**
 * Class PermissionRepository
 *
 * @package Railroad\Railcontent\Repositories
 */
class PermissionRepository extends RepositoryBase
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
     * @var DatabaseManager
     */
    protected $databaseManager;

    /**
     * Create a new permisssion and return the permission id
     *
     * @param string $name
     * @return integer
     */
    public function create($name)
    {
        $permissionId = $this->query()->insertGetId(
            [
                'name' => $name,
                'created_on' => Carbon::now()->toDateTimeString(),
            ]
        );

        return $permissionId;
    }

    /**
     * Update a permission and return the permission id
     *
     * @param integer $id
     * @param string $name
     * @return bool
     */
    public function update($id, $name)
    {
        return $this->query()->where(['id' => $id])->update(['name' => $name]) > 0;
    }

    /**
     * Delete a permission
     *
     * @param integer $id
     * @return integer
     */
    public function delete($id)
    {
        $delete = $this->query()->where('id', $id)->delete();

        return $delete;
    }

    public function getAll()
    {
        $query = $this->query();

        return $query->get();
    }

    /**
     * Return a permission based on it's id
     *
     * @param integer $id
     * @return mixed
     */
    public function getById($id)
    {
        $query = $this->query();

        return $query
            ->select(
                ConfigService::$tablePermissions . '.*'
            )
            ->where(ConfigService::$tablePermissions . '.id', $id)->get()->first();
    }

    /**
     * Create a new record in railcontent_content_permission with the permission id and the specific content($contentId) or the content type
     *
     * @param integer $permissionId
     * @param integer|null $contentId
     * @param string|null $contentType
     * @return integer
     */
    public function assign(
        $permissionId,
        $contentId = null,
        $contentType = null
    ) {
        $permissionId = $this->contentPermissionQuery()->insert(
            [
                'content_id' => $contentId,
                'content_type' => $contentType,
                'required_permission_id' => $permissionId
            ]
        );

        return $permissionId;
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return parent::connection()->table(ConfigService::$tablePermissions)->select(
            ConfigService::$tablePermissions . '.*'
        );
    }

    /**
     * @return Builder
     */
    public function contentPermissionQuery()
    {
        return parent::connection()->table(ConfigService::$tableContentPermissions);
    }

}