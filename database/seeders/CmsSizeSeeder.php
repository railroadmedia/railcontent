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
    public function run(): void
    {
        //
        $sizes = [
            [
                'name' => 'X-Small',
                'code' => 'XS',
            ],
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
                'code' => 'XXL',
            ],
            [
                'name' => 'XXX-Large',
                'code' => 'XXXL',
            ],
            [
                'name' => 'XXXX-Large',
                'code' => 'XXXXL',
            ],
            [
                'name' => 'S/M',
                'code' => 'S',
            ],
            [
                'name' => 'L/XL',
                'code' => 'L',
            ],
        ];

        foreach($sizes as $size) {
            Size::create([
                'name' => $size['name'],
                'code' => $size['code']
            ]);
        }
    }
}
