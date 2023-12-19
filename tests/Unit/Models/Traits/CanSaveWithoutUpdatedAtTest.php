<?php

namespace Tests\Unit\Models\Traits;

use App\Models\ShopifySync;
use App\Models\Traits\CanSaveWithoutUpdatedAt;
use App\Modules\Ecommerce\Models\Product;
use Carbon\Carbon;
use Tests\TestCase;

class CanSaveWithoutUpdatedAtTest extends TestCase
{
    protected Product $usesTrait;
    protected ShopifySync $doesntUseTrait;

    public function test_class_without_trait_save_does_update_field()
    {
        $this->doesntUseTrait = ShopifySync::create([
            "resource" => ShopifySync::RESOURCE_CUSTOMER,
            "started_at" => Carbon::now()
        ]);
        $this->assertNotContains(CanSaveWithoutUpdatedAt::class, class_uses($this->doesntUseTrait));
        $updated_at = $this->doesntUseTrait->updated_at;
        $this->travel(1)->hour();
        $this->doesntUseTrait->resource = ShopifySync::RESOURCE_ORDER;
        $this->doesntUseTrait->save();
        $this->doesntUseTrait->refresh();
        $this->assertNotEquals($updated_at, $this->doesntUseTrait->updated_at);
    }

    public function test_normal_save_does_update_field()
    {
        $this->usesTrait = Product::factory()->create();
        $this->assertContains(CanSaveWithoutUpdatedAt::class, class_uses($this->usesTrait));
        $updated_at = $this->usesTrait->updated_at;
        $this->travel(1)->hour();
        $this->usesTrait->name = "Updated";
        $this->usesTrait->save();
        $this->usesTrait->refresh();
        $this->assertNotEquals($updated_at, $this->usesTrait->updated_at);
    }

    public function test_can_save_without_updated_at_does_not_update_field()
    {
        $this->usesTrait = Product::factory()->create();
        $this->assertContains(CanSaveWithoutUpdatedAt::class, class_uses($this->usesTrait));
        $updated_at = $this->usesTrait->updated_at;
        $this->travel(1)->hour();
        $this->usesTrait->name = "Updated";
        $this->usesTrait->saveWithoutUpdatedAt();
        $this->usesTrait->refresh();
        $this->assertEquals($updated_at, $this->usesTrait->updated_at);
    }
}
