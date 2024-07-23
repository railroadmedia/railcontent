<?php

namespace App\Modules\Ecommerce\database\factories;

use App\Enums\Interval;
use App\Modules\Content\database\factories\PermissionFactory;
use App\Modules\Ecommerce\Enums\DigitalAccessType;
use App\Modules\Ecommerce\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => fake()->word,
            'sku' => fake()->word . rand(100000, 10000000),
            'fulfillment_sku' => fake()->word . rand(100000, 10000000),
            'inventory_control_sku' => fake()->word . rand(100000, 10000000),
            'price' => fake()->numberBetween(1, 1000),
            'type' => fake()->randomElement(
                [
                    Product::TYPE_DIGITAL_ONE_TIME,
                    Product::TYPE_DIGITAL_SUBSCRIPTION,
                    Product::TYPE_PHYSICAL_ONE_TIME,
                ]
            ),
            'active' => 1,
            'category' => fake()->word,
            'description' => fake()->text,
            'thumbnail_url' => fake()->imageUrl(),
            'sales_page_url' => fake()->url,
            'is_physical' => fake()->randomElement([0, 1]),
            'weight' => fake()->numberBetween(0, 100),
            'subscription_interval_type' => fake()->randomElement(
                [
                    config('ecommerce.interval_type_daily'),
                    config('ecommerce.interval_type_monthly'),
                    config('ecommerce.interval_type_yearly'),
                ]
            ),
            'subscription_interval_count' => fake()->numberBetween(0, 12),
            'stock' => fake()->numberBetween(100, 1000),
            'auto_decrement_stock' => fake()->randomElement([0, 1]),
            'brand' => config('ecommerce.brand'),
            'note' => fake()->text,
            'created_at' => Carbon::now()
                ->toDateTimeString(),
            'public_stock_count' => fake()->numberBetween(1, 1000),
            'digital_access_time_interval_length' => 0,
            'digital_access_time_type' => null,
            'digital_access_time_interval_type' => null,
            'digital_access_type' => null,
            'digital_access_permission_names' => '[]',
            'shopify_id' => fake()->numberBetween(1000000000000, 9999999999999),
        ];
    }

    public static function createSubscriptionProduct(
        string $brand,
        DigitalAccessType $accessType,
        ?Interval $interval,
        float $price,
        array $attributes = []
    ): Product {
        $attributes = array_merge($attributes, [
            'brand' => $brand,
            'price' => $price,
            'type' => Product::TYPE_DIGITAL_SUBSCRIPTION,
            'digital_access_type' => $accessType->value,
            'digital_access_time_interval_type' => $interval?->value,
            'digital_access_time_interval_length' => 1,
        ]);
        switch ($accessType) {
            case DigitalAccessType::Basic:
                $attributes['digital_access_permission_names'] = '["Musora Basic Membership"]';
                break;
            case DigitalAccessType::Plus:
                $attributes['digital_access_permission_names'] = '["Musora Plus Membership"]';
                break;
            case DigitalAccessType::Songs:
                $attributes['digital_access_permission_names'] = '["Musora Only Songs Membership"]';
                break;
            default:
                throw new Exception("Not implemented");
        }
        return Product::factory()->create($attributes);
    }

    public static function createLifetimeProduct(
        array $attributes = []
    ): Product {
        $attributes = array_merge($attributes, [
            'brand' => 'musora',
            'type' => Product::TYPE_DIGITAL_ONE_TIME,
            'digital_access_type' => DigitalAccessType::Basic->value,
            'digital_access_time_type' => 'lifetime',
            'digital_access_permission_names' => '["Drumeo Lifetime Member","Musora Basic Membership"]'
        ]);
        return Product::factory()->create($attributes);
    }

    public static function createPackProduct(
        array $attributes = []
    ): Product {
        $attributes = array_merge($attributes, [
            'brand' => 'musora',
            'type' => Product::TYPE_DIGITAL_ONE_TIME,
            'digital_access_type' => DigitalAccessType::Specific->value,
            'digital_access_permission_names' => '["' . PermissionFactory::TestPackName . '"]',
        ]);
        return Product::factory()->create($attributes);
    }

    /**
     * Create a new product as configured in production, for the given sku.
     *
     * @throws Exception
     */
    public static function createProductForSku(string $sku): Product
    {
        return match ($sku) {
            "drumeo-base-monthly-recurring-7-day-trial-membership" => Product::create([
                'brand' => "drumeo",
                'name' => "Drumeo Monthly Membership | With 7-Day Trial",
                'sku' => "drumeo-base-monthly-recurring-7-day-trial-membership",
                'inventory_control_sku' => "17001",
                'fulfillment_sku' => "membership",
                'price' => 25.00,
                'type' => "digital subscription",
                'active' => 1,
                'category' => "NULL",
                'description' => "7 days free, then $25 / month. Easy to cancel anytime. Includes access to Drumeo’s step-by-step method, lessons from legendary artists, and unlimited personal support.",
                'thumbnail_url' => "'https' =>//d1923uyy6spedc.cloudfront.net/Drumeo-cart-2-1643147388.png",
                'sales_page_url' => null,
                'is_physical' => 0,
                'weight' => 0.00,
                'subscription_interval_type' => "month",
                'subscription_interval_count' => 1,
                'stock' => 999999,
                'min_stock_level' => 0,
                'public_stock_count' => 0,
                'auto_decrement_stock' => 0,
                'digital_access_permission_names' => "[\"Musora Basic Membership\"]",
                'digital_access_type' => "basic content access",
                'digital_access_time_interval_type' => "day",
                'digital_access_time_type' => "recurring",
                'digital_access_time_interval_length' => 7,
                'digital_membership_access_expiration_date' => null,
                'shopify_id' => 47070845370644,
                'note' => null,
            ]),
            "DLM-Trial-1-month" => Product::create([
                'brand' => "drumeo",
                'name' => "Drumeo+ Monthly Membership: Includes Songs | With 7-Day Trial",
                'sku' => "DLM-Trial-1-month",
                'inventory_control_sku' => "17001",
                'fulfillment_sku' => "membership",
                'price' => 30.00,
                'type' => "digital subscription",
                'active' => 1,
                'category' => "NULL",
                'description' => "7 days free, then $30 / month. Easy to cancel anytime. Includes access to Drumeo’s step-by-step method, lessons from legendary artists, and unlimited personal support. As a “+” member, you’ll also get access to 5000+ professionally transcribed songs.",
                'thumbnail_url' => "'https' =>//d1923uyy6spedc.cloudfront.net/Drumeo-cart-2-1643147388.png",
                'sales_page_url' => null,
                'is_physical' => 0,
                'weight' => 0.00,
                'subscription_interval_type' => "month",
                'subscription_interval_count' => 1,
                'stock' => 999999,
                'min_stock_level' => 0,
                'public_stock_count' => 0,
                'auto_decrement_stock' => 0,
                'digital_access_permission_names' => "[\"Musora Basic Membership\"]",
                'digital_access_type' => "basic content access",
                'digital_access_time_interval_type' => "day",
                'digital_access_time_type' => "recurring",
                'digital_access_time_interval_length' => 7,
                'digital_membership_access_expiration_date' => null,
                'shopify_id' => 47070758797588,
                'note' => null,
            ]),
            "DLM-1-month" => Product::create([
                'brand' => "drumeo",
                'name' => "Drumeo+ Monthly Membership: Includes Songs",
                'sku' => "DLM-1-month",
                'inventory_control_sku' => "17001",
                'fulfillment_sku' => null,
                'price' => 30.00,
                'type' => "digital subscription",
                'active' => 1,
                'category' => "NULL",
                'description' => "Access to Drumeo’s library of lessons by legendary coaches, step-by-step method, and a personal mentor for support and guidance. As a “+” member you also get access to thousands of professionally transcribed songs.",
                'thumbnail_url' => "https://d1923uyy6spedc.cloudfront.net/Drumeo-cart-2-1643147388.png",
                'sales_page_url' => "/",
                'is_physical' => 0,
                'weight' => 0.00,
                'subscription_interval_type' => "month",
                'subscription_interval_count' => 1,
                'stock' => 999999,
                'min_stock_level' => 0,
                'public_stock_count' => 0,
                'auto_decrement_stock' => 0,
                'digital_access_permission_names' => "[\"Drumeo Edge\",\"Musora Plus Membership\"]",
                'digital_access_type' => "all content access",
                'digital_access_time_interval_type' => "month",
                'digital_access_time_type' => "recurring",
                'digital_access_time_interval_length' => 1,
                'digital_membership_access_expiration_date' => null,
                'shopify_id' => 47070758240532,
                'note' => null,
            ]),
            default => throw new Exception(
                sprintf("sku %s has not been configured. Please update createProductForSku to include it.", $sku)
            ),
        };
    }
}
