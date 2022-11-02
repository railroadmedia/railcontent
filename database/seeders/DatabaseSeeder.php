<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CmsBrandSeeder::class,
            CmsProductTypeSeeder::class,
            CmsSizeSeeder::class,
            CmsSizeChartSeeder::class,
            CmsLessonSeeder::class,
            CmsClothingSeeder::class,
            CmsAccessorySeeder::class,
            CmsBundleSeeder::class,
        ]);
    }
}
