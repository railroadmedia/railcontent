<?php

namespace App\Modules\Ecommerce\Jobs\Shopify\Traits;

use Illuminate\Support\Str;

trait HandlesMaskedEmailAddress
{
    // this would be a const, if we were on PHP 8.2
    protected string $fakeSuffix = ".ex";

    /**
     * Are we using masked email addresses with Shopify?
     *
     * @return bool
     */
    abstract protected function getIsUsingMask(): bool;

    /**
     * Get the unmasked value of the given email address from Shopify
     *
     * @param string $email
     * @return string
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
     * Get the masked value of the given email address, to send to Shopify
     *
     * @param string $email
     * @return string
     */
    protected function getEmailForShopify(string $email): string
    {
        if ($this->getIsUsingMask()) {
            return $email . $this->fakeSuffix;
        }
        return $email;
    }
}
