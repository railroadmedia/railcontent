<?php

namespace Railroad\Railcontent\Providers;

use Railroad\Railcontent\DataTransferObjects\ContentURLs;
use Railroad\Railcontent\Entities\ContentEntity;

interface RailcontentProviderInterface
{
    public function getBlockedUsers(): ?array;
}
