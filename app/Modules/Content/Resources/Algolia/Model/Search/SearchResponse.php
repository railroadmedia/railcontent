<?php

namespace App\Modules\Content\Resources\Algolia\Model\Search;

use Algolia\AlgoliaSearch\Model\Search\SearchResponse as AlgoliaSearchResponse;
use App\Modules\Content\Resources\Algolia\Enum\Index;
use App\Modules\Content\Resources\Algolia\Model\Search\Hit\AllHit;
use App\Modules\Content\Resources\Algolia\Model\Search\Hit\MusoraHitClass;
use App\Modules\Content\Resources\Algolia\Model\Search\Hit\SongHit;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Services\ContentService;

class SearchResponse extends AlgoliaSearchResponse
{
    public function __construct(?array $data = null, public ?Index $index = null)
    {
        parent::__construct($data);
    }

    public static function fromAlgoliaResponse(AlgoliaSearchResponse $baseResponse, ?Index $index = null): self
    {
        $customResponse = new self();
        $customResponse->index = $index;
        foreach (get_object_vars($baseResponse) as $property => $value) {
            if (property_exists($customResponse, $property)) {
                $customResponse->$property = $value;
            }
        }
        return $customResponse;
    }

    /**
     * Format the SearchResponse into a JSON string that our front-end and mobile app can use
     */
    public function formatToJson(): string
    {
        return json_encode(['data' => $this->getDataForJson(), 'meta' => $this->getMetaForJson()]);
    }

    /**
     * Get the 'meta' data required for the JSON-formatted response
     */
    protected function getMetaForJson(): array
    {
        $meta = [];
        $meta['totalResults'] = $this->getNbHits();
        $meta['page'] = $this->getPage();
        $meta['limit'] = $this->getHitsPerPage();

        return $meta;
    }

    /**
     * Get the 'data' data required for the JSON-formatted response
     */
    protected function getDataForJson(): array
    {
        $data = [];
        $hits = collect($this->getHits());
        // retrieve all our related railcontent data first, so we can do this in one DB call
        // use the ContentService to retrieve the full data with additional values, instead of a normal Eloquent query
        $contentService = app(ContentService::class);
        $railcontentData = $contentService->getByIds($hits->pluck('railcontent_id')->toArray())->transform(fn (ContentEntity $entity) => $entity->dot())->keyBy('id');

        $hits->each(function ($hit) use ($railcontentData, &$data) {
            try {
                $data[] = $this->formatDataForHit($hit, $railcontentData[$hit->railcontent_id]);
            } catch (Exception $e) {
                Log::error($e->getMessage());
            }
        });

        return $data;
    }


    /**
     * Format the Hit data combined with our internal data to generate the data required in the response
     *
     * @param  MusoraHitClass  $hitClass
     * @param  array  $contentData - NOT a Content model, because we've run decorators to get the extra data we need
     * @return array
     * @throws Exception
     */
    private function formatDataForHit(MusoraHitClass $hitClass, array $contentData): array
    {
        if ($this->index === Index::All) {
            /** @var AllHit $hit */
            $hit = $hitClass;
        } elseif ($this->index === Index::Song) {
            /** @var SongHit $hit */
            $hit = $hitClass;
        } else {
            throw new Exception('Hit format has not been defined for index ' . $this->index?->value);
        }

        $data = [];
        $data["id"] = $contentData['id'];
        $data["slug"] = $hit->slug;
        $data["type"] = $hit->type;
        $data["status"] = $hit->status;
        $data["brand"] = $hit->brand;
        $data["popularity"] = $hit->popularity;
        $data["difficulty_string"] = $hit->difficulty;
        $data["published_on"] = $hit->published_on?->toDateTimeString() ?? null;
        $data["language"] = $hit->language;
        $data["web_url_path"] = $hit->web_url_path;
        $data["total_xp"] = $hit->total_xp;
        $data['thumbnail_url'] = $hit->thumbnail_url;
        $data['original_thumbnail_url'] = $hit->thumbnail_url;
        $data['album'] = $hit->album ?? null;
        $data['difficulty'] = $hit->difficulty;
        $data['title'] = $hit->title ?? null;

        // TODO: remove these once we can. Update Algolia and musora-sanity-algolia to add any additional fields that should be there
        // DEV NOTE: apply data from the railcontent entry to keep parity for now.
        // handle any special cases here, otherwise just loop through everything next
        $data["created_on"] = $contentData['created_on'] instanceof Carbon ? $contentData['created_on']->toDateTimeString() : $contentData['created_on'];
        $data["archived_on"] = $contentData['archived_on'] instanceof Carbon ? $contentData['archived_on']->toDateTimeString() : $contentData['archived_on'];
        $data["quarter_removed"] = $contentData['quarter_removed'] instanceof Carbon ? $contentData['quarter_removed']->toDateString() : $contentData['quarter_removed'];
        $data["quarter_published"] = $contentData['quarter_published'] instanceof Carbon ? $contentData['quarter_published']->toDateString() : $contentData['quarter_published'];
        $data["instructors"] = $contentData['*instructors'];
        $data["coaches"] = $contentData['*coaches'];
        $data["user_playlists"] = $contentData['*user_playlists'];
        $data["published_on_in_timezone"] = $contentData['published_on_in_timezone'] instanceof Carbon ? $contentData['published_on_in_timezone']->toDateString() : $contentData['published_on_in_timezone'];
        $data['data'] = $contentData['*data'] ?? [];
        $data['fields'] = $contentData['*fields'] ?? [];

        // safety fallback to get anything we might've missed (other than the array dot values and the unnecessary compiled_view_data)
        foreach (array_keys($contentData) as $key) {
            if (!array_key_exists($key, $data)
                && $key !== 'compiled_view_data'
                && !Str::startsWith($key, ['instructors.', 'coaches.', 'data.', 'fields.', 'user_playlists.'])) {
                $data[$key] = $contentData[$key];
            }
        }

        return $data;
    }
}
