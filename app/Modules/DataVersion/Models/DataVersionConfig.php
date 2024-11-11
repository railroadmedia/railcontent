<?php

namespace App\Modules\DataVersion\Models;

use App\Modules\DataVersion\Enums\UserDataVersionKeyEnum;

class DataVersionConfig
{
    public function __construct(
        private UserDataVersionKeyEnum $versionKey,
        private bool $isEnabled,
        private int $versionCheckPollingIntervalSeconds,
        private int $fullRefreshIntervalSeconds
    ) {
    }

    public function getVersionKey(): UserDataVersionKeyEnum
    {
        return $this->versionKey;
    }

    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    public function getVersionCheckPollingIntervalSeconds(): int
    {
        return $this->versionCheckPollingIntervalSeconds;
    }

    public function getFullRefreshIntervalSeconds(): int
    {
        return $this->fullRefreshIntervalSeconds;
    }

    public function toArray(): array
    {
        return [
            "enabled" => $this->isEnabled,
            "checkInterval" => $this->versionCheckPollingIntervalSeconds,
            "refreshInterval" => $this->fullRefreshIntervalSeconds
        ];
    }
}
