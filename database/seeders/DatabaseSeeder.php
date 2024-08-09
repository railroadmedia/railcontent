<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Size;
use App\Models\SizeChart;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Brand::truncate();
        ProductType::truncate();
        Size::truncate();
        SizeChart::truncate();
        $this->call([
            CmsBrandSeeder::class,
            CmsProductTypeSeeder::class,
            CmsSizeSeeder::class,
            CmsSizeChartSeeder::class,
            CmsLessonSeeder::class,
            CmsClothingSeeder::class,
            CmsAccessorySeeder::class,
            CmsBundleSeeder::class,
            BFUpdates::class,
            CmsPlaylistLikesPinsSeeder::class,
            CmsPlaylistContentSeeder::class,
        ]);
    }
}
