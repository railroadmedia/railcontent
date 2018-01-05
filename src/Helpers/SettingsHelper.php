<?php

namespace Railroad\Railcontent\Helpers;


use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Services\ConfigService;

class SettingsHelper
{
    public static function getSettings()
    {
        //dd(implode(' ',array_values(PermissionRepository::$availableContentPermissionIds)));
        return ContentRepository::$pullFutureContent . ' '.ConfigService::$brand . ' ' . implode(' ',array_values(PermissionRepository::$availableContentPermissionIds));
    }
}