<?php

namespace Modules\UserManagementSystem\DataTransferObjects;

enum AuthenticationType: string
{
    case Cookie = 'cookie';
    case Token = 'token';
}
