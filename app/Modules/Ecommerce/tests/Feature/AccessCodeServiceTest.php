<?php

namespace App\Modules\Ecommerce\tests\Feature;

use App\Modules\Ecommerce\database\factories\AccessCodeFactory;
use App\Modules\Ecommerce\database\factories\ProductFactory;
use App\Modules\Ecommerce\Models\AccessCode;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\AccessCodeService;
use Event;
use Exception;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class AccessCodeServiceTest extends TestCase
{
    private AccessCodeService $accessCodeService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->accessCodeService = $this->app->make(AccessCodeService::class);
    }

    public function test_claim()
    {
        Event::fake();

        $product = Product::factory()->create();
        $accessCode = AccessCodeFactory::createAccessCode($product);
        $user = User::factory()->create();

        $this->accessCodeService->claimByUserId($accessCode->code, $user->id);
        $this->assertDatabaseHas('ecommerce_access_codes', [
            'id' => $accessCode->id,
            'is_claimed' => 1,
            'claimer_id' => $user->id
        ]);

        $this->expectException(Exception::class);
        $this->accessCodeService->claimByUserId($accessCode->code, $user->id);
    }


}
