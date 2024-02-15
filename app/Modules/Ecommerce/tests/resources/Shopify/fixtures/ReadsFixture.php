<?php

namespace App\Modules\Ecommerce\tests\resources\Shopify\fixtures;

trait ReadsFixture
{
    protected function fixture(string $name): array
    {
        $json = file_get_contents(__DIR__.'/'.$name.'.json');

        return json_decode($json, true);
    }
}
