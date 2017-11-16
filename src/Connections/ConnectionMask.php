<?php

namespace Railroad\Railcontent\Connections;

use Illuminate\Database\Connection;
use Railroad\Railcontent\Services\ConfigService;

class ConnectionMask extends Connection
{
    public function getName()
    {
        return ConfigService::$connectionMaskPrefix . ConfigService::$databaseConnectionName;
    }
}