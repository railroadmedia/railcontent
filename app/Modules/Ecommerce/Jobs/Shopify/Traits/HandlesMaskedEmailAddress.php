<?php

namespace App\Modules\Ecommerce\Jobs\Shopify\Traits;

use App\Modules\UserManagementSystem\Console\Commands\CreateUser;
use App\Modules\UserManagementSystem\Services\TestingService;
use Illuminate\Support\Str;

trait HandlesMaskedEmailAddress
{
    // this would be a const, if we were on PHP 8.2
    public string $fakeSuffix = ".ex";

    /**
     * Get the unmasked value of the given email address from Shopify
     */
    protected function getEmailFromShopify(string $email): string
    {
        if ($this->getIsUsingMask()) {
            // DEV NOTE: this will return the full $email value of the fakeSuffix isn't found
            // BUT it could break at the wrong spot if the email value has the fakeSuffix in it, like drum.expert@mail.com,
            // so we need to make sure if ends with the fakeSuffix, before splitting it
            if (Str::endsWith($email, $this->fakeSuffix)) {
                return Str::beforeLast($email, $this->fakeSuffix);
            }
        }
        return $email;
    }

    /**
     * Are we using masked email addresses with Shopify?
     */
    protected function getIsUsingMask(): bool
    {
        return !app()->isProduction();
    }

    /**
     * Get the masked value of the given email address, to send to Shopify
     */
    protected function getEmailForShopify(string $email): string
    {
        if ($this->getIsUsingMask() && !$this->ignoreEmailRegex($email)) {
            return $email . $this->fakeSuffix;
        }
        return $email;
    }

    private function ignoreEmailRegex(string $email): bool
    {
        if (str_starts_with($email, TestingService::EmailPrefix) && str_ends_with(
            $email,
            TestingService::EmailPostfix
        )) {
            return true;
        }

        return false;
    }
}
