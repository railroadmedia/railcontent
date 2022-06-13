<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $products = [
            [
                "brand" => 1,
                "productType" => 1,
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
                "features" => [

                ],
                "specs" => [
                    [
                        "title" => "",
                        "desc" => ""
                    ]
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShopping" => false,
                "logo" => "",
                "video" => "",
                "instructorName" => "",
                "instructorDesc" => "",
                "studyText" => "",
                "overview" => "",
                "images" => [

                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 1,
                "productType" => 1,
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
                "features" => [

                ],
                "specs" => [
                    [
                        "title" => "",
                        "desc" => ""
                    ]
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShopping" => false,
                "logo" => "",
                "video" => "",
                "instructorName" => "",
                "instructorDesc" => "",
                "studyText" => "",
                "overview" => "",
                "images" => [

                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
        ];
    }
}
