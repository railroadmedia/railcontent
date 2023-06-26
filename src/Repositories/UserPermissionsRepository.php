<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;
use Railroad\Railcontent\Services\ConfigService;

class UserPermissionsRepository extends RepositoryBase
{
    public function query()
    {
        return parent::connection()
            ->table(ConfigService::$tableUserPermissions);
    }

    /** Pull the user permissions record
     *
     * @param integer|null $userId
     * @param boolean $onlyActive
     * @return array
     */
    public function getUserPermissions($userId, $onlyActive)
    {
        $query =
            $this->query()
                ->join(
                    ConfigService::$tablePermissions,
                    function (JoinClause $join) {
                        $join->on(
                            ConfigService::$tablePermissions . '.id',
                            '=',
                            ConfigService::$tableUserPermissions . '.permission_id'
                        );
                    }
                );
        if ($onlyActive) {
            $query = $query->where(
                function ($query) {
                    $query->whereDate(
                        'expiration_date',
                        '>=',
                        Carbon::now()
                            ->toDateTimeString()
                    )
                        ->orWhereNull('expiration_date');
                }
            )->where(
                function ($query) {
                    $query->whereDate(
                        'start_date',
                        '<=',
                        Carbon::now()
                            ->toDateTimeString()
                    )
                        ->orWhereNull('start_date');
                }
            );
        }
        if ($userId) {
            $query = $query->where(ConfigService::$tableUserPermissions . '.user_id', $userId);
        }

        return $query->get()
            ->toArray();
    }

    /**
     * @param int $userId
     * @param int $permissionId
     * @return array
     */
    public function getIdByPermissionAndUser($userId, $permissionId)
    {
        return $this->query()
            ->where('user_id', $userId)
            ->where('permission_id', $permissionId)
            ->get()
            ->toArray();
    }

    /**
     * @param int $userId
     * @param int $permissionName
     * @return boolean
     */
    public function userHasPermissionName($userId, $permissionName)
    {
        return $this->query()
            ->join(
                ConfigService::$tablePermissions,
                ConfigService::$tablePermissions . '.id',
                '=',
                ConfigService::$tableUserPermissions . '.permission_id'
            )
            ->where(
                function ($query) {
                    $query->whereDate(
                        'expiration_date',
                        '>=',
                        Carbon::now()
                            ->toDateTimeString()
                    )
                        ->orWhereNull('expiration_date');
                }
            )
            ->where(
                function ($query) {
                    $query->whereDate(
                        'start_date',
                        '<=',
                        Carbon::now()
                            ->toDateTimeString()
                    )
                        ->orWhereNull('start_date');
                }
            )
            ->where('user_id', $userId)
            ->where('name', $permissionName)
            ->exists();
    }


    public function userHasPermissionsWithFutureStartDate($userId)
    {
        return $this->query()
            ->join(
                ConfigService::$tablePermissions,
                ConfigService::$tablePermissions . '.id',
                '=',
                ConfigService::$tableUserPermissions . '.permission_id'
            )
            ->where(
                function ($query) {
                    $query->whereDate(
                        'expiration_date',
                        '>=',
                        Carbon::now()
                            ->toDateTimeString()
                    )
                        ->orWhereNull('expiration_date');
                }
            )
            ->where(
                function ($query) {
                    $query->whereDate(
                        'start_date',
                        '>=',
                        Carbon::now()
                            ->toDateTimeString()
                    )
                        ->orWhereNull('start_date');
                }
            )
            ->where('user_id', $userId)
            ->exists();
    }
}