<?php

namespace App\Modules\Ecommerce\Jobs\Shopify\Traits;

use Illuminate\Support\Collection;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Entities\Address;
use Railroad\Ecommerce\Repositories\AddressRepository;

trait SyncsShopifyCustomer
{
    use LogsShopify;

    /**
     * For the given collection of Addresses, clean up the data and format it in a way that Shopify will accept
     *
     * @param Collection<Address> $addresses
     * @return Collection
     */
    protected function cleanUpAddresses(Collection $addresses): Collection
    {
        // only use addresses that have at least streetLine1, since we may have addresses with no real data
        $addresses = $addresses->filter(function (Address $address) {
            return !empty($address->getStreetLine1());
        });

        // order them to start with the most recent, just in case of duplicates (we have some cases where the region is all caps, and some not, etc)
        $addresses = $addresses->sort(function (Address $address1, Address $address2) {
            return $address1->getUpdatedAt() < $address2->getUpdatedAt();
        });

        // transform it to fit Shopify's data structure
        $addresses->transform(function(Address $address) {
            return  [
                "address1" => $address->getStreetLine1(),
                "address2" => $address->getStreetLine2(),
                "city" => $address->getCity(),
                "country" => $address->getCountry(),
                "firstName" => $address->getFirstName(),
                "lastName" => $address->getLastName(),
                "province" => $address->getRegion(),
                "zip" => $address->getZip()
            ];
        });

        // and make sure it's unique - Shopify won't allow multiple addresses with the same data
        return $addresses->unique(function (array $address) {
            // ignore case
            return strtoupper($address["address1"]).
                strtoupper($address["address2"]).
                strtoupper($address["city"]).
                strtoupper($address["country"]).
                strtoupper($address["firstName"]).
                strtoupper($address["lastName"]).
                strtoupper($address["province"]).
                strtoupper($address["zip"]);
        });
    }

    /**
     * Get the E.164 formatted phone number for the given user
     *
     * @param User $user
     * @return string|null
     */
    protected function getPhoneNumberForUser(User $user): ?string
    {
        // get the raw phone number value
        $phoneNumber = $user->phone_number;

        if (empty($phoneNumber)) {
            return null;
        }

        // get the user's country, so we can supply the country code
        $address = $this->cleanUpAddresses(
            collect($this->getAddressRepository()->getUserShippingAddresses($user->id))
        )->first();

        if (is_array($address) && array_key_exists("country", $address)) {
            $countryName = $address["country"];
        } else {
            $countryName = $address?->getCountry();
        }
        $countryCode = $this->countryNameToISO3166($countryName ?? "Canada");

        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            $phoneNumberObject = $phoneUtil->parse($phoneNumber, $countryCode);
            return $phoneUtil->format($phoneNumberObject, PhoneNumberFormat::E164);
        } catch (NumberParseException $e) {
            $this->logError(sprintf("Unable to format phone number %s for User ID %s: %s", $phoneNumber, $user->id, $e->getMessage()));
        }
        return null;
    }

    /**
     * Get the ISO 3166 country code for the given country name
     * @author https://www.php.net/manual/en/locale.getdisplayregion.php#119895
     *
     * @param $countryName
     * @return string|null
     */
    protected function countryNameToISO3166($countryName): ?string
    {
        $language = "EN";
        $countryCode_list = array('AF', 'AX', 'AL', 'DZ', 'AS', 'AD', 'AO', 'AI', 'AQ', 'AG', 'AR', 'AM', 'AW', 'AU', 'AT', 'AZ', 'BS', 'BH', 'BD', 'BB', 'BY', 'BE', 'BZ', 'BJ', 'BM', 'BT', 'BO', 'BQ', 'BA', 'BW', 'BV', 'BR', 'IO', 'BN', 'BG', 'BF', 'BI', 'KH', 'CM', 'CA', 'CV', 'KY', 'CF', 'TD', 'CL', 'CN', 'CX', 'CC', 'CO', 'KM', 'CG', 'CD', 'CK', 'CR', 'CI', 'HR', 'CU', 'CW', 'CY', 'CZ', 'DK', 'DJ', 'DM', 'DO', 'EC', 'EG', 'SV', 'GQ', 'ER', 'EE', 'ET', 'FK', 'FO', 'FJ', 'FI', 'FR', 'GF', 'PF', 'TF', 'GA', 'GM', 'GE', 'DE', 'GH', 'GI', 'GR', 'GL', 'GD', 'GP', 'GU', 'GT', 'GG', 'GN', 'GW', 'GY', 'HT', 'HM', 'VA', 'HN', 'HK', 'HU', 'IS', 'IN', 'ID', 'IR', 'IQ', 'IE', 'IM', 'IL', 'IT', 'JM', 'JP', 'JE', 'JO', 'KZ', 'KE', 'KI', 'KP', 'KR', 'KW', 'KG', 'LA', 'LV', 'LB', 'LS', 'LR', 'LY', 'LI', 'LT', 'LU', 'MO', 'MK', 'MG', 'MW', 'MY', 'MV', 'ML', 'MT', 'MH', 'MQ', 'MR', 'MU', 'YT', 'MX', 'FM', 'MD', 'MC', 'MN', 'ME', 'MS', 'MA', 'MZ', 'MM', 'NA', 'NR', 'NP', 'NL', 'NC', 'NZ', 'NI', 'NE', 'NG', 'NU', 'NF', 'MP', 'NO', 'OM', 'PK', 'PW', 'PS', 'PA', 'PG', 'PY', 'PE', 'PH', 'PN', 'PL', 'PT', 'PR', 'QA', 'RE', 'RO', 'RU', 'RW', 'BL', 'SH', 'KN', 'LC', 'MF', 'PM', 'VC', 'WS', 'SM', 'ST', 'SA', 'SN', 'RS', 'SC', 'SL', 'SG', 'SX', 'SK', 'SI', 'SB', 'SO', 'ZA', 'GS', 'SS', 'ES', 'LK', 'SD', 'SR', 'SJ', 'SZ', 'SE', 'CH', 'SY', 'TW', 'TJ', 'TZ', 'TH', 'TL', 'TG', 'TK', 'TO', 'TT', 'TN', 'TR', 'TM', 'TC', 'TV', 'UG', 'UA', 'AE', 'GB', 'US', 'UM', 'UY', 'UZ', 'VU', 'VE', 'VN', 'VG', 'VI', 'WF', 'EH', 'YE', 'ZM', 'ZW');
        $ISO3166 = NULL;
        foreach ($countryCode_list as $countryCode) {
            $locale_cc = \Locale::getDisplayRegion('-' . $countryCode, $language);
            if (strcasecmp($countryName, $locale_cc) == 0) {
                $ISO3166 = $countryCode;
                break;
            }
        }
        return $ISO3166;
    }

    /**
     * The Address Repository used to interact with the Ecommerce Address entities
     *
     * @return AddressRepository
     */
    abstract protected function getAddressRepository(): AddressRepository;
}
