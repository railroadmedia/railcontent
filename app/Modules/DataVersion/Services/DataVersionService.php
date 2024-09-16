<?php

namespace App\Modules\DataVersion\Services;

use App\Modules\DataVersion\Enums\UserDataVersionKeyEnum;
use App\Modules\DataVersion\Models\UserDataVersion;

class DataVersionService
{
    public function wrapDataArrayWithVersion(UserDataVersionKeyEnum $dataKey, array $data, int $userId): array
    {
        return ['version' => $this->getUserDataVersion($dataKey, $userId), 'data' => $data];
    }


    public function incrementUserContextVersion(UserDataVersionKeyEnum $dataKey, int $userId): void
    {
        $version = $this->getUserDataVersion($dataKey, $userId);
        if (!$version) {
            $version = new UserDataVersion();
            $version->user_id = $userId;
            $version->data_key = $dataKey;
        }
        $version->version = $version->version + 1;
        $version->save();
    }

    public function getUserDataVersion(UserDataVersionKeyEnum $dataKey, int $userId)
    {
        return $this->getUserDataVersionObject($dataKey, $userId)?->version;
    }

    private function getUserDataVersionObject(UserDataVersionKeyEnum $dataKey, int $userId)
    {
        return UserDataVersion::query()
            ->where('data_key', $dataKey->value)
            ->where('user_id', $userId)
            ->first();
    }

}
