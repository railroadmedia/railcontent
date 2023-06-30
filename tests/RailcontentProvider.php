<?php

namespace App\Providers;

use App\Decorators\Content\UrlDecorator;
use Modules\UserManagementSystem\Models\BlockedUser;
use Railroad\Railcontent\DataTransferObjects\ContentURLs;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Providers\RailcontentProviderInterface;
use Railroad\Railcontent\Providers\RailcontentURLProviderInterface;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Support\Collection;

use function App\Providers\user;

class RailcontentProvider implements RailcontentProviderInterface
{
    public function getBlockedUsers()
    : ?array
    {
        return [];
    }
}
