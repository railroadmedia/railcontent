<?php

namespace App\Modules\Ecommerce\tests\Feature;

use App\Modules\Ecommerce\database\factories\AccessCodeFactory;
use App\Modules\Ecommerce\Models\AccessCode;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\AccessCodeService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\UserManagementSystem\Models\User;
use Queue;
use Tests\TestCase;

class AccessCodeServiceTest extends TestCase
{
    private AccessCodeService $accessCodeService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->accessCodeService = $this->app->make(AccessCodeService::class);
    }

    public function test_generate_access_code(): void
    {
        $product = Product::factory()->create();

        $accessCode = $this->accessCodeService->generateAccessCode([$product->id], $product->brand, 'foo-bar');

        $this->assertDatabaseHas(
            AccessCode::class,
            [
                'id' => $accessCode->id,
                'brand' => $product->brand,
                'product_ids' => serialize([$product->id]),
                'source' => 'foo-bar'
            ]
        );
        $this->assertNotNull($accessCode->code);
        $this->assertFalse($accessCode->is_claimed);
    }

    public function test_claim(): void
    {
        Queue::fake(); //ignore customerIO jobs

        $product = Product::factory()->create();
        $accessCode = AccessCodeFactory::createAccessCode($product);
        $user = User::factory()->create([
            'shopify_id' => null //hack to skip subscription check
        ]);

        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) {
                return Str::contains($message, 'Access code claimed');
            });

        $this->accessCodeService->claimByUserId($accessCode->code, $user->id);
        $this->assertDatabaseHas('ecommerce_access_codes', [
            'id' => $accessCode->id,
            'is_claimed' => 1,
            'claimer_id' => $user->id
        ]);

        $this->expectException(Exception::class);
        $this->accessCodeService->claimByUserId($accessCode->code, $user->id);

        $this->assertDatabaseHas('usora_users', [
            'id' => $user->id,
            'primary_brand' => $accessCode->brand
        ]);
    }
}
