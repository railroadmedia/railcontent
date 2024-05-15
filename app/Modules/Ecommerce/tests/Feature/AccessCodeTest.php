<?php

namespace App\Modules\Ecommerce\tests\Feature;

use App\Modules\Ecommerce\Models\Product;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AccessCodeTest extends TestCase
{
    public function test_generate_access_code(): void
    {
        Mail::fake();
        $product = Product::factory()->create();
        $this->artisan("generateAccessCodes $product->id 1 test_source --execute")->assertExitCode(0);

        $this->assertDatabaseHas('ecommerce_access_codes', [
            'is_claimed' => 0,
            'product_ids' => 'a:1:{i:0;i:1;}',
            'brand' => $product->brand,
            'source' => 'test_source'
        ]);
    }

    //    public function test_get_access_codes(): void
    //    {
    //        $user = User::factory()->create();
    //        $this->actingAs($user);
    //
    //        $results = $this->json(
    //            'get',
    //            'ecommerce/access-codes?brands[]=drumeo&brands[]=pianote&brands[]=guitareo&brands[]=recordeo&brands[]=singeo&brands[]=musora&limit=20&page=1&order_by_column=created_at&order_by_direction=desc'
    //        );
    //        Need to create proper access permission to continue.
    //    }

    public function test_claim_access_code(): void
    {
        $this->markTestSkipped("TODO write a test for this");
    }
}
