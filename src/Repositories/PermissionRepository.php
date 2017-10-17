<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\SearchInterface;
use Railroad\Railcontent\Services\SearchService;

/**
 * Class PermissionRepository
 *
 * @package Railroad\Railcontent\Repositories
 */
class PermissionRepository extends LanguageRepository implements SearchInterface
{
    protected $search, $databaseManager;

    /**
     * Search constructor.
     * @param SearchInterface $searchService
     */
    public function __construct(SearchInterface $search)
    {
        $this->search = $search;
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
                'created_on' => Carbon::now()->toDateTimeString(),
            ]
        );

        //save permission name
        $this->saveTranslation(
            [
                'entity_type' => ConfigService::$tablePermissions,
                'entity_id' => $permissionId,
                'value' => $name
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
        //delete old permission nanme
        $this->deleteTranslations([
            'entity_type' => ConfigService::$tablePermissions,
            'entity_id' => $id
        ]);

        //save new permission name
        $this->saveTranslation(
            [
                'entity_type' => ConfigService::$tablePermissions,
                'entity_id' => $id,
                'value' => $name
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
        //delete permission name
        $this->deleteTranslations([
            'entity_type' => ConfigService::$tablePermissions,
            'entity_id' => $id
        ]);

        $delete = $this->queryTable()->where('id', $id)->delete();

        return $delete;
    }

    public function getAll()
    {
        $query = $this->queryTable();
        $query = $this->addTranslations($query);

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
        $query = $this->addTranslations($query);

        return $query
            ->select(ConfigService::$tablePermissions.'.*', 'translation_'.ConfigService::$tablePermissions.'.value as name')
            ->where(ConfigService::$tablePermissions.'.id', $id)->get()->first();
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
        return parent::connection()->table(ConfigService::$tablePermissions)->select(ConfigService::$tablePermissions.'.*');
    }

    /**
     * @return Builder
     */
    public function contentPermissionQuery()
    {
        return parent::connection()->table(ConfigService::$tableContentPermissions);
    }

    /** Generate the query builder
     * @return Builder
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
            ->leftJoin(
                ConfigService::$tableTranslations, function($join) {
                return $join->on(ConfigService::$tableTranslations.'.entity_id', ConfigService::$tablePermissions.'.id')
                    ->where(ConfigService::$tableTranslations.'.entity_type', '=', ConfigService::$tablePermissions);
            }
            )
            ->where(function($builder) use ($permissions) {
                return $builder->whereNull(ConfigService::$tablePermissions.'.id')
                    ->orWhereIn(ConfigService::$tableTranslations.'.value', $permissions);
            });
        return $query;
    }
}