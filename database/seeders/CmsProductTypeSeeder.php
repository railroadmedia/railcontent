<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $types = [
            'Lessons', 'Accessories', 'Hats', 'Shirts', 'Hoodies', 'Bundles'
        ];

        foreach($types as $type) {
            ProductType::create([
                'name' => $type
            ]);
        }
    }
}
