<?php

namespace App\Modules\DataVersion\Services;

use App\Modules\DataVersion\Enums\UserDataVersionKeyEnum;
use App\Modules\DataVersion\Models\UserDataVersion;

class DataVersionService
{
    public function incrementUserContextVersion(UserDataVersionKeyEnum $dataKey, int $userId): int
    {
        $version = $this->getUserDataVersionObject($dataKey, $userId);
        if (!$version) {
            $version = new UserDataVersion();
            $version->user_id = $userId;
            $version->data_key = $dataKey;
            $version->version = UserDataVersion::DefaultVersion;
        }
        $version->version = $version->version + 1;
        $version->save();
        return $version->version;
    }

    public function getUserDataVersion(UserDataVersionKeyEnum $dataKey, int $userId)
    {
        return $this->getUserDataVersionObject($dataKey, $userId)?->version ?? UserDataVersion::DefaultVersion;
    }

    private function getUserDataVersionObject(UserDataVersionKeyEnum $dataKey, int $userId)
    {
        return UserDataVersion::query()
            ->where('data_key', $dataKey->value)
            ->where('user_id', $userId)
            ->first();
    }

}
