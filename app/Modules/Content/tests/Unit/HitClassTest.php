<?php

namespace App\Modules\Content\tests\Unit;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Brand\Enums\Status;
use App\Modules\Content\Resources\Algolia\Enum\DocumentType;
use App\Modules\Content\Resources\Algolia\Model\Search\Hit\AllHit;
use App\Modules\Content\Resources\Algolia\Model\Search\Hit\SongHit;
use Carbon\Carbon;
use Tests\TestCase;

class HitClassTest extends TestCase
{
    public function test_all_properties_are_set(): void
    {
        $values = [
            '_id' => $this->faker->uuid,
            'objectID' => $this->faker->uuid,
            'rev' => $this->faker->uuid,
            'railcontent_id' => $this->faker->randomNumber,
            'brand' => $this->faker->randomElement(array_column(Brand::cases(), 'value')),
            'description' => $this->faker->text,
            'difficulty' => $this->faker->word,
            'instructor_names' => [$this->faker->name(), $this->faker->name(), $this->faker->name()],
            'language' => $this->faker->languageCode,
            'popularity' => $this->faker->randomNumber,
            'slug' => $this->faker->slug,
            'status' => $this->faker->randomElement(array_column(Status::cases(), 'value')),
            'thumbnail_url' => $this->faker->imageUrl,
            'title' => $this->faker->word,
            'topics' => $this->faker->words,
            'total_xp' => $this->faker->randomNumber,
            'type' => $this->faker->randomElement(array_column(DocumentType::cases(), 'value')),
            'web_url_path' => $this->faker->url
        ];

        $hit = new AllHit($values);

        foreach ($values as $key => $value) {
            $this->assertEquals($value, $hit->$key);
        }
    }

    public function test_all_special_properties_are_cast_properly(): void
    {
        $values = [
            'published_on' => $this->faker->date,
        ];

        $hit = new AllHit($values);

        $this->assertEquals(Carbon::parse($values['published_on']), $hit->published_on);
    }

    public function test_invalid_property_is_skipped(): void
    {
        $invalid = 'foo_bar';
        $values = [
            $invalid => 'baz',
        ];

        $hit = new AllHit($values);

        $this->expectException(\ErrorException::class);
        $nonexistent = $hit->$invalid;

        $reflection = new \ReflectionClass($hit);
        $this->assertNotContains($invalid, $reflection->getProperties());
    }

    public function test_song_properties_are_set(): void
    {
        $values = [
            '_id' => $this->faker->uuid,
            'objectID' => $this->faker->uuid,
            'rev' => $this->faker->uuid,
            'railcontent_id' => $this->faker->randomNumber,
            'album' => $this->faker->word,
            'artist' => $this->faker->name,
            'brand' => $this->faker->randomElement(array_column(Brand::cases(), 'value')),
            'difficulty' => $this->faker->word,
            'genre' => [$this->faker->word],
            'language' => $this->faker->languageCode,
            'popularity' => $this->faker->randomNumber,
            'slug' => $this->faker->slug,
            'status' => $this->faker->randomElement(array_column(Status::cases(), 'value')),
            'thumbnail_url' => $this->faker->imageUrl,
            'title' => $this->faker->word,
            'total_xp' => $this->faker->randomNumber,
            'type' => $this->faker->randomElement(array_column(DocumentType::cases(), 'value')),
            'web_url_path' => $this->faker->url
        ];

        $hit = new SongHit($values);

        foreach ($values as $key => $value) {
            $this->assertEquals($value, $hit->$key);
        }
    }

    public function test_song_special_properties_are_cast_properly(): void
    {
        $values = [
            'published_on' => $this->faker->date,
        ];

        $hit = new SongHit($values);

        $this->assertEquals(Carbon::parse($values['published_on']), $hit->published_on);
    }
}
