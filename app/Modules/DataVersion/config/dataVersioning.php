<?php


use App\Modules\DataVersion\Enums\UserDataVersionKeyEnum;
use App\Modules\DataVersion\Models\DataVersionConfig;

return [
    UserDataVersionKeyEnum::ContentLikes->value => new DataVersionConfig(
        UserDataVersionKeyEnum::ContentLikes,
        true,
        10,
        0
    ),
    UserDataVersionKeyEnum::ContentProgress->value => new DataVersionConfig(
        UserDataVersionKeyEnum::ContentProgress,
        true,
        10,
        0
    ),
];
