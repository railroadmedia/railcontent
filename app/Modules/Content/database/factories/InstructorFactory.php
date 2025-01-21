<?php

namespace App\Modules\Content\database\factories;

use App\Modules\Content\Models\Content;
use Carbon\Carbon;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Services\ContentService;

class InstructorFactory extends ContentFactory
{
    protected $model = Content::class;

    public function definition(): array
    {
        $name = $this->faker->name();
        $brand = 'drumeo';
        return [
            'slug' => ContentHelper::slugify($name),
            'type' => 'instructor',
            'name' => $this->faker->name(),
            'endorsements' => implode(' ', $this->faker->words()),
            'bands' => implode(' ', $this->faker->words()),
            'sort' => 0,
            'status' => ContentService::STATUS_PUBLISHED,
            'brand' => $brand,
            'language' => 'en-US',
            'published_on' => Carbon::now()->addDays(-30),
            'created_on' => Carbon::now()->addDays(-40),
        ];
    }
}
