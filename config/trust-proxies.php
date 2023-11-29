<?php

$proxies = [];

if(env('TRUSTED_PROXIES')){
    foreach (explode(',', env('TRUSTED_PROXIES')) as $ip) {
        $proxies[] = $ip;
    }
}
return [
    'proxies' => $proxies
];
