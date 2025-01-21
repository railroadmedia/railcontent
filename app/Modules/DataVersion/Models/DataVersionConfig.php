<?php

namespace App\Modules\DataVersion\Models;

use App\Modules\DataVersion\Enums\UserDataVersionKeyEnum;

readonly class DataVersionConfig
{
    private const string DATA_KEY = "key";
    private const string DATA_ENABLED = "enabled";
    private const string DATA_CHECK_INTERVAL = "checkInterval";
    private const string DATA_REFRESH_INTERVAL = "refreshInterval";

    private array $data;

    public function __construct(
        UserDataVersionKeyEnum $versionKey,
        bool $isEnabled,
        int $versionCheckPollingIntervalSeconds,
        int $fullRefreshIntervalSeconds
    ) {
        $this->data = [
            self::DATA_KEY => $versionKey->value,
            self::DATA_ENABLED => $isEnabled,
            self::DATA_CHECK_INTERVAL => $versionCheckPollingIntervalSeconds,
            self::DATA_REFRESH_INTERVAL => $fullRefreshIntervalSeconds
        ];
    }

    public static function __set_state(array $state_array): static
    {
        return new static(
            UserDataVersionKeyEnum::tryFrom($state_array['data'][self::DATA_KEY]),
            $state_array['data'][self::DATA_ENABLED],
            $state_array['data'][self::DATA_CHECK_INTERVAL],
            $state_array['data'][self::DATA_REFRESH_INTERVAL]
        );
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function isEnabled(): bool
    {
        return $this->data[self::DATA_ENABLED];
    }
}
