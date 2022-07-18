<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Spec;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsAccessorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                "brand" => 3,
                "productType" => 2,
                "name" => "",
                "slug" => "",
                "sku" => "",
                "thumbnail" => "",
                "metaDesc" => "",
                "metaImg" => "",
                "shortDesc" => "",
                "headerText" => "",
                "price" => 1,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                    ""
                ],
                "specs" => [
                    [
                        "title" => "Volume",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Height",
                        "desc" => "Flexfit Wool Blend 6477"
                    ],
                    [
                        "title" => "Diameter",
                        "desc" => "83% Acrylic / 14% Wool / 2% Spandex"
                    ],
                    [
                        "title" => "Materials",
                        "desc" => "Black"
                    ],
                    [
                        "title" => "Finish",
                        "desc" => "Black"
                    ],
                    [
                        "title" => "Washing",
                        "desc" => "Black"
                    ],
                    [
                        "title" => "Microwave",
                        "desc" => "Black"
                    ],
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [

                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
        ];

        foreach($products as $product) {
            $newProduct = Product::create([
                'brand_id' => $product['brand'],
                'product_type_id' => $product['productType'],
                'name' => $product['name'],
                'slug' => $product['slug'],
                'sku' => $product['sku'],
                'page_logo' => empty($product['page_logo']) ? null : $product['page_logo'],
                'thumbnail' => $product['thumbnail'],
                'header_text' => $product['headerText'],
                'short_desc' => $product['shortDesc'],
                'meta_desc' => $product['metaDesc'],
                'meta_img' => $product['metaImg'],
                'special_text' => $product['specialText'],
                'price' => $product['price'],
                'discounted_price' => $product['discountedPrice'],
                'overview' => empty($product['overview']) ? null : $product['overview'],
                'product_img' => empty($product['product_img']) ? null : $product['product_img'],
                'sold_out' => $product['soldOut'],
                'free_shipping' => $product['freeShipping'],
                'guaranteed' => $product['badge'],
                'visible' => $product['visible'],
                'free_bonus' => $product['freeBonus'],
                'membership_discount' => false,
                'lifetime_access' => $product['lifeTime'],
                'size_chart_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach($product['features'] as $key => $feature){
                Feature::create([
                    'product_id' => $newProduct->id,
                    'desc' => $feature,
                    'order_number' => $key
                ]);
            }

            foreach($product['specs'] as $key => $spec){
                Spec::create([
                    'product_id' => $newProduct->id,
                    'title' => $spec['title'],
                    'desc' => $spec['desc'],
                    'order_number' => $key,
                ]);
            }

            foreach($product['images'] as $key => $image){
                Image::create([
                    'product_id' => $newProduct->id,
                    'path' => $image,
                    'order_number' => $key
                ]);
            }

            foreach($product['sizes'] as $size){
                ProductSize::create([
                    'product_id' => $newProduct->id,
                    'size_id' => $size
                ]);
            }
        }
    }
}
