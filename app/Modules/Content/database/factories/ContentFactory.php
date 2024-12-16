<?php

namespace App\Modules\Content\database\factories;

use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentField;
use App\Modules\Content\Models\ContentInstructor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Services\ContentService;

class ContentFactory extends Factory
{
    protected $model = Content::class;

    public function definition(): array
    {
        $title = implode(' ', $this->faker->words());
        $brand = 'drumeo';
        return [
            'slug' => ContentHelper::slugify($title),
            'type' => 'song',
            'sort' => 0,
            'status' => ContentService::STATUS_PUBLISHED,
            'brand' => $brand,
            'language' => 'en-US',
            'title' => $title,
            'published_on' => Carbon::now()->addDays(-30),
            'created_on' => Carbon::now()->addDays(-40),
        ];
    }

    public function hasInstructor(Content $instructor): self
    {
        return $this->afterCreating(function (Content $content) use ($instructor) {
            ContentField::factory()->create([
                'key' => 'instructor',
                'value' => $instructor->id,
                'type' => 'content_id',
                'content_id' => $content,
                'position' => 1
            ]);
            ContentInstructor::factory()->create([
                'content_id' => $content->id,
                'instructor_id' => $instructor->id,
            ]);
        });
    }
}
