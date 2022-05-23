<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $sizes = [
            [
                'name' => 'Small',
                'code' => 'S',
            ],
            [
                'name' => 'Medium',
                'code' => 'M',
            ],
            [
                'name' => 'Large',
                'code' => 'L',
            ],
            [
                'name' => 'X-Large',
                'code' => 'XL',
            ],
            [
                'name' => 'XX-Large',
                'code' => '2XL',
            ],
            [
                'name' => 'XXX-Large',
                'code' => '3XL',
            ],
            [
                'name' => 'XXXX-Large',
                'code' => '4XL',
            ],
        ];

        foreach($sizes as $size){
            Size::create([
                'name' => $size['name'],
                'code' => $size['code']
            ]);
        }
    }
}
