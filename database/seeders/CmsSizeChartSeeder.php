<?php

namespace Database\Seeders;

use App\Models\SizeChart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsSizeChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        //
        $charts = [
            'Size_Chart/size_chart_1.png',
            'Size_Chart/size_chart_2.png',
            'Size_Chart/size_chart_3.png',
            'Size_Chart/size_chart_4.png',
            'Size_Chart/size_chart_5.png',
            'Size_Chart/size_chart_6.png',
            'Size_Chart/size_chart_7.png',
            'Size_Chart/size_chart_8.png',
            'Size_Chart/size_chart_9.png',
            'Size_Chart/size_chart_10.png',
            'Size_Chart/size_chart_11.png',
            'Size_Chart/size_chart_12.png',
            'Size_Chart/size_chart_13.png',
            'Size_Chart/size_chart_14.png',
            'Size_Chart/size_chart_15.png',
            'Size_Chart/size_chart_16.png',
            'Size_Chart/size_chart_17.png',
            'Size_Chart/size_chart_18.png',
        ];

        foreach($charts as $chart) {
            SizeChart::create([
                'chart' => $chart
            ]);
        }
    }
}
