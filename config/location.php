<?php

return [
    'common-at-top' => [ // for usage example, see CountryListService::allWithCommonDuplicatedAtTop()
        'US', # United States of America (the)
        'CA', # Canada
        'GB', # United Kingdom of Great Britain and Northern Ireland (the)
        'AU', # Austrailia
    ],
    'countries-name-altered' => [
        'TW' => 'Taiwan',           # renamed from "Taiwan (Province of China)"
        'US' => 'United States',    # renamed from "United States of America (the)"
        'GB' => 'United Kingdom',   # renamed from "United Kingdom of Great Britain and Northern Ireland (the)"
    ],
    /*
     * Non-standard user-defined entries
     * ---------------------------------
     *
     * If a country is not represented in ISO 3166, we can add it here. However remember that is not standardized and
     * thus cannot be assumed to have to same meaning elsewhere. For example, "XK" is used by many—but not
     * all—organizations to represent Kosovo.
     *
     * "User-assigned code elements are codes at the disposal of users who need to add further names of countries,
     * territories, or other geographical entities to their in-house application of ISO 3166-1, and the ISO 3166/MA will
     * never use these codes in the updating process of the standard. The following alpha-2 codes can be user-assigned:
     * AA, QM to QZ, XA to XZ, and ZZ."
     * source: https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2#User-assigned_code_elements, March 12th 2021
     * Also see https://en.wikipedia.org/wiki/ISO_3166-1_numeric#User-assigned_code_elements regarding numerics)
     */
    'user-defined' => [
        [
            'name' => 'Kosovo',
            'alpha2' => 'XK',
            'alpha3' => 'XKS',
            'numeric' => 900,
            'currency' => ['EUR'],
        ]
    ],

    'environment' => env('APP_ENV', 'local'),
    'testing_ip' => '108.172.176.221',
    'active_api' => 'ipdata.co',
    'api' =>
        [
            'ipdata.co' => [
                'url' => 'https://api.ipdata.co/',
                'apiKey' => env('IP_DATA_API_KEY', '3e2874cc4be1cd0bdb4c4197614c8dd9494fc50bc3c57e0485970413'),
                'countryKey' => 'country_name',
                'countryCodeKey' => 'country_code',
                'regionNameKey' => 'region',
                'latitudeKey' => 'latitude',
                'longitudeKey' => 'longitude',
            ],
            'freegeoip.net' => [
                'url' => 'http://freegeoip.net/json/',
                'countryKey' => 'country_name',
                'countryCodeKey' => 'country_code',
                'regionNameKey' => 'region_name',
                'latitudeKey' => 'latitude',
                'longitudeKey' => 'longitude',
            ],
            'ip-api.com' => [
                'url' => 'http://ip-api.com/json/',
                'countryKey' => 'country',
                'countryCodeKey' => 'countryCode',
                'regionNameKey' => 'regionName',
                'latitudeKey' => 'lat',
                'longitudeKey' => 'lon',
                'cityKey' => 'city',
            ],
        ],
];
