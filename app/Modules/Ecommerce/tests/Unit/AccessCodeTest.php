<?php

namespace App\Modules\Ecommerce\tests\Unit;

use App\Modules\Ecommerce\Models\AccessCode;
use App\Modules\Ecommerce\Models\Product;
use Tests\TestCase;

class AccessCodeTest extends TestCase
{
    public function test_generate_access_code(): void
    {
        $product = Product::factory()->create();
        $this->artisan("generateAccessCodes $product->id 1 test_source --execute")->assertExitCode(0);

        $this->assertDatabaseHas('ecommerce_access_codes', [
            'is_claimed' => 0,
            'product_ids' => 'a:1:{i:0;i:1;}',
            'brand' => $product->brand,
            'source' => 'test_source'
        ]);
    }
}
