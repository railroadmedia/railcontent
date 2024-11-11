<?php

namespace App\Modules\DataVersion\Models;

use App\Modules\DataVersion\Enums\UserDataVersionKeyEnum;

readonly class DataVersionConfig
{
    public function __construct(
        private UserDataVersionKeyEnum $versionKey,
        private bool $isEnabled,
        private int $versionCheckPollingIntervalSeconds,
        private int $fullRefreshIntervalSeconds
    ) {
    }

    public function __serialize(): array
    {
        return $this->toArray();
    }

    public function __unserialize(array $data): void
    {
        $this->versionKey = UserDataVersionKeyEnum::tryFrom($data["key"]);
        $this->isEnabled = $data['enabled'];
        $this->versionCheckPollingIntervalSeconds = $data['checkInterval'];
        $this->fullRefreshIntervalSeconds = $data['refreshInterval'];
    }

    public function toArray(): array
    {
        return [
            "key" => $this->versionKey->value,
            "enabled" => $this->isEnabled,
            "checkInterval" => $this->versionCheckPollingIntervalSeconds,
            "refreshInterval" => $this->fullRefreshIntervalSeconds
        ];
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
}
