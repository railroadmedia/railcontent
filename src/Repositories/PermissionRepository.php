<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
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
    protected $search, $databaseManager;

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
     * Create a new permisssion and return the permission id
     *
     * @param string $name
     * @return integer
     */
    public function create($name)
    {
        $permissionId = $this->queryTable()->insertGetId(
            [
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
     * @return integer
     */
    public function update($id, $name)
    {
        return $id;
    }

    /**
     * Delete a permission
     *
     * @param integer $id
     * @return integer
     */
    public function delete($id)
    {
        $delete = $this->queryTable()->where('id', $id)->delete();

        return $delete;
    }

    public function getAll()
    {
        $query = $this->queryTable();

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
        $query = $this->queryTable();

        return $query
            ->select(
                ConfigService::$tablePermissions . '.*',
                'translation_' . ConfigService::$tablePermissions . '.value as name'
            )
            ->where(ConfigService::$tablePermissions . '.id', $id)->get()->first();
    }

    /**
     * Return the content ids or type that are linked with the permission
     *
     * @param $id
     * @return mixed
     */
    public function linkedWithContent($id)
    {
        $contentIdLabel = ConfigService::$tableContent . '.id';

        return $this->contentPermissionQuery()
            ->select('content_id', 'content_type')
            ->leftJoin(ConfigService::$tableContent, 'content_id', '=', $contentIdLabel)
            ->where(
                [
                    'required_permission_id' => $id
                ]
            )->get();
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
    public function queryTable()
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

    /** Generate the query builder
     *
     * @param Builder $query
     * @return Builder
     */
    public function restrictContentQueryByPermissions(Builder $query)
    {
        if (is_array(self::$availableContentPermissionIds)) {

            $query
                ->leftJoin(
                    ConfigService::$tableContentPermissions,
                    function (JoinClause $join) {
                        return $join
                            ->on(
                                ConfigService::$tableContentPermissions . '.content_id',
                                ConfigService::$tableContent . '.id'
                            )
                            ->orOn(
                                ConfigService::$tableContentPermissions . '.content_type',
                                ConfigService::$tableContent . '.type'
                            );
                    }
                )
                ->leftJoin(
                    ConfigService::$tablePermissions,
                    ConfigService::$tablePermissions . '.id',
                    '=',
                    ConfigService::$tableContentPermissions . '.required_permission_id'
                )
                ->where(
                    function (Builder $builder) {
                        return $builder->whereNull(ConfigService::$tablePermissions . '.id')
                            ->orWhereIn(
                                ConfigService::$tableTranslations . '.value',
                                self::$availableContentPermissionIds
                            );
                    }
                );

        }

        return $query;
    }
}