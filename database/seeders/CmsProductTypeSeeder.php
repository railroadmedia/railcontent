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
            'Clothing', 'Lesson', 'Accessory'
        ];

        foreach($types as $type){
            ProductType::create([
                'name' => $type
            ]);
        }
    }
}
