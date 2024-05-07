<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $brands = [
            "Drumeo", "Pianote", "Guitareo", "Singeo"
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand
            ]);
        }
    }
}
