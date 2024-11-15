<?php

namespace App\Modules\Content\Resources\Algolia\Enum;

/**
 * A Facet is an attribute in the Algolia index that can be used for filtering.
 * These are set in the Configuration tab of the index, under the Facets space.
 */
enum Facet: string
{
    case Topics = 'topics';
    case InstructorNames = 'instructor_names';
    case DifficultyString = 'difficulty';
    case Brand = 'brand';
    case Popularity = 'popularity';
    case PublishedOn = 'published_on';
    case Status = 'status';
    case DocumentType = '_type';
    case ArtistName = 'artist';
    case Album = 'album';
    case Genre = 'genre';

    public const string TYPE_STRING = 'string';
    public const string TYPE_NUMERIC = 'numeric';
    public const string TYPE_ARRAY = 'array';
    public const string TYPE_DATE_TIMESTAMP = 'date_timestamp ';

    /**
     * Get all Facets that are available for the given Index
     *
     * @return self[]
     */
    public static function getForIndex(Index $index): array
    {
        return match ($index) {
            Index::Song => self::cases(),
            Index::All,
            Index::Pack,
            Index::Workout,
            Index::StudentFocus,
            Index::SongTutorial,
            Index::Rudiment,
            Index::Routine,
            Index::QuickTips,
            Index::Podcast,
            Index::PlayAlong,
            Index::Course,
            Index::Bootcamp => Collect(Facet::cases())->reject(
                fn (self $attribute) => in_array($attribute, [self::ArtistName, self::Album, self::Genre])
            )->toArray()
        };
    }

    /**
     * Get the string representation of the type of this facet's attribute field
     *
     * @return string
     */
    public function getAttributeType(): string
    {
        return match ($this) {
            self::DifficultyString,
            self::Brand,
            self::Status,
            self::DocumentType,
            self::ArtistName,
            self::Album => self::TYPE_STRING,
            self::Popularity => self::TYPE_NUMERIC,
            self::Topics,
            self::InstructorNames,
            self::Genre => self::TYPE_ARRAY,
            self::PublishedOn => self::TYPE_DATE_TIMESTAMP,
        };
    }
}
