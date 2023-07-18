<?php

namespace Railroad\Railcontent\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentPermissionRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;

/**
 * Class PermissionService
 *
 * @package Railroad\Railcontent\Services
 */
class PermissionService
{
    /**
     * @var PermissionRepository
     */
    public $permissionRepository;

    /**
     * @var ContentPermissionRepository
     */
    protected $contentPermissionRepository;

    /**
     * @var ContentRepository
     */
    protected $contentRepository;

    /**
     * PermissionService constructor.
     *
     * @param PermissionRepository $permissionRepository
     * @param ContentPermissionRepository $contentPermissionRepository
     */
    public function __construct(
        PermissionRepository $permissionRepository,
        ContentPermissionRepository $contentPermissionRepository,
        ContentRepository $contentRepository
    ) {
        $this->permissionRepository = $permissionRepository;
        $this->contentPermissionRepository = $contentPermissionRepository;
        $this->contentRepository = $contentRepository;
    }

    /**
     * Call getById method from PermissionRepository and return the permission
     *
     * @param integer $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->permissionRepository->getById($id);
    }

    /**
     * @return array
     */
    public function getAll()
    {
        $hash = 'permissions_' . CacheHelper::getKey();
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $results = CacheHelper::saveUserCache($hash, $this->permissionRepository->getAll(), null);
        }

        return $results;
    }

    /**
     * @param string $name
     * @return array
     */
    public function getByName($name)
    {
        $hash = 'permissions_name' . CacheHelper::getKey($name);
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $results = CacheHelper::saveUserCache($hash, $this->permissionRepository->query()->where('name', $name)->get()->toArray(), null);
        }

        return $results;
    }

    /**
     * Call the create method from PermissionRepository and return the new permission
     *
     * @param string $name
     * @param null $brand
     * @return mixed
     */
    public function create($name, $brand = null)
    {
        $permissionId = $this->permissionRepository->create(
            [
                'name' => $name,
                'brand' => $brand ?? ConfigService::$brand
            ]
        );
        CacheHelper::deleteAllCachedSearchResults('permissions_' . CacheHelper::getKey());

        return $this->get($permissionId);
    }

    /**
     * Call update method from PermissionRepository and return the updated permission
     *
     * @param integer $id
     * @param string $name
     * @param null $brand
     * @return mixed
     */
    public function update($id, $name, $brand = null)
    {
        //check if permission exist in the database
        $permission = $this->get($id);

        if (is_null($permission)) {
            return $permission;
        }

        $this->permissionRepository->update(
            $id,
            ['name' => $name, 'brand' => $brand ?? ConfigService::$brand]
        );

        CacheHelper::deleteAllCachedSearchResults('permissions_' . CacheHelper::getKey());

        return $this->get($id);
    }

    /**
     * Call delete method from PermissionRepository and return true if the permission was deleted
     *
     * @param integer $id
     * @return bool
     */
    public function delete($id)
    {
        //check if permission exist in the database
        $permission = $this->get($id);

        if (is_null($permission)) {
            return $permission;
        }
        $associatedContentIds = array_filter(Arr::pluck($this->contentPermissionRepository->getContentAssociationBasedOnPermissionId($id), 'content_id'));
        CacheHelper::deleteCacheKeys($associatedContentIds);
        $associatedContentTypes = array_filter(Arr::pluck($this->contentPermissionRepository->getContentAssociationBasedOnPermissionId($id), 'content_type'));
        foreach ($associatedContentTypes as $contentType) {
            $contentIds = $this->contentRepository->getByType($contentType);
            CacheHelper::deleteCacheKeys($contentIds);
        }
        CacheHelper::deleteAllCachedSearchResults('permissions_' . CacheHelper::getKey());

        $this->contentPermissionRepository->unlinkPermissionFromAllContent($id);

        return $this->permissionRepository->delete($id) > 0;
    }
}