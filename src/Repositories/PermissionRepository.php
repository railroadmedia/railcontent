<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 9/7/2017
 * Time: 9:29 AM
 */

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Requests\ContentIndexRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\SearchInterface;
use Railroad\Railcontent\Services\SearchService;

/**
 * Class PermissionRepository
 *
 * @package Railroad\Railcontent\Repositories
 */
class PermissionRepository extends RepositoryBase implements SearchInterface
{
    protected $search, $databaseManager;

    /**
     * Search constructor.
     * @param $searchService
     */
    public function __construct(DatabaseManager $databaseManager, SearchInterface $search)
    {
        $this->search = $search;
        $this->databaseManager = $databaseManager;

        parent::__construct($databaseManager);
    }
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
     * @return integer
     */
    public function update($id, $name)
    {
        $this->queryTable()->where('id', $id)->update(
            [
                'name' => $name
            ]
        );

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
        return $this->queryTable()->get();
    }

    /**
     * Return a permission based on it's id
     *
     * @param integer $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->queryTable()->where('id', $id)->get()->first();
    }

    /**
     * Return the content ids or type that are linked with the permission
     *
     * @param $id
     * @return mixed
     */
    public function linkedWithContent($id)
    {
        $contentIdLabel = ConfigService::$tableContent.'.id';

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
        $contentType = null)
    {
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
        return parent::connection()->table(ConfigService::$tablePermissions);
    }

    /**
     * @return Builder
     */
    public function contentPermissionQuery()
    {
        return parent::connection()->table(ConfigService::$tableContentPermissions);
    }

    /**
     *      * @return mixed
     */
    public function generateQuery()
    {
        $query = $this->search->generateQuery();

        //get permissions from requests or empty array
        $permissions = request()->permissions ?? [];

        $query->leftJoin(
            ConfigService::$tableContentPermissions, function($join) {
            return $join->on(ConfigService::$tableContentPermissions.'.content_id', ConfigService::$tableContent.'.id')
                ->orOn(ConfigService::$tableContentPermissions.'.content_type', ConfigService::$tableContent.'.type');
        }
        )
            ->leftJoin(
                ConfigService::$tablePermissions,
                ConfigService::$tablePermissions.'.id',
                '=',
                ConfigService::$tableContentPermissions.'.required_permission_id'
            )
            ->where(function($builder) use ($permissions) {
                return $builder->whereNull(ConfigService::$tablePermissions.'.name')
                    ->orWhereIn(ConfigService::$tablePermissions.'.name', $permissions);
            });;

        return $query;
    }
}