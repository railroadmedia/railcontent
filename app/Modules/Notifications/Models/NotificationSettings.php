<?php

namespace App\Modules\Notifications\Models;

use Illuminate\Database\Eloquent\Collection;

class NotificationSettings
{
    private array $settingsLookup;

    public function __construct(Collection $settings)
    {
        foreach ($settings as $setting) {
            /** @var NotificationSetting $setting */
            $this->settingsLookup[$setting->brand][$setting->setting_name] = $setting->setting_value;
        }
    }

    public function getSetting(string $brand, string $settingName): bool
    {
        return $this->settingsLookup[$brand][$settingName] ?? true;
    }
}
