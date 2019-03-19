<?php

namespace Railroad\Railcontent\Connections;

use Illuminate\Database\Connection;


class ConnectionMask extends Connection
{
    public function getName()
    {
        return config('railcontent.connection_mask_prefix') . config('railcontent.database_connection_name');
    }
}