<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\Content;
use Carbon\Carbon;
use DB;

class ContentUpdatePopularity extends Command
{
    protected $signature = 'content:updatePopularityMWP';

    protected $description = 'Updates the content popularity column';

    public function handle(SanityGateway $sanityGateway): void
    {
        $this->withExecutionTime(function () use ($sanityGateway) {
            $startDate = Carbon::now()->subDays(30)->startOfDay()->toDateTimeString();
            $popularityData = $this->getPopularityData($startDate);
            $this->updatePopularity($popularityData, $sanityGateway);
        });
    }

    public function updatePopularity(array $popularityData, SanityGateway $sanityGateway): void
    {
        $this->info("Updating popularity results in Sanity.io");

        $nUpdated = 0;
        $popularityChunked = array_chunk($popularityData, 1000);

        $artistPopularity = [];
        $genrePopularity = [];


        foreach ($popularityChunked as $popularityChunk) {
            $existingIds = collect(
                $sanityGateway->getExistingPopularityData(
                    collect($popularityChunk)
                        ->pluck('id')
                        ->toArray()
                )
            )->keyBy('railcontent_id');

            $patches = [];
            foreach ($popularityChunk as $contentData) {
                $contentId = $contentData['id'];
                $popularity = $contentData['value'];
                $id = $existingIds[$contentId]['_id'] ?? null;
                if ($id) {
                    if ($existingIds[$contentId]['popularity'] != $popularity) {
                        $patches[$id] = [
                            'popularity' => (int) $popularity,
                        ];
                    }
                    $artistId = $existingIds[$contentId]['artistId'];
                    $brand = $existingIds[$contentId]['brand'];
                    if ($artistId) {
                        $artistPopularity[$artistId][$brand] = $popularity + ($artistPopularity[$artistId][$brand] ?? 0);
                    }
                    collect($existingIds[$contentId]['genreIds'])->unique()->each(
                        function ($genreId) use (&$genrePopularity, $popularity, $brand) {
                            $genrePopularity[$genreId][$brand] = $popularity + ($genrePopularity[$genreId][$brand] ?? 0);
                        }
                    );
                }
            }
            if (count($patches) > 0) {
                $sanityGateway->patchSetMany($patches);
                $nUpdated += count($patches);
                $this->info("$nUpdated results updated in Sanity.io");
            }

            usleep(1000);
        }

        $genrePatches = [];
        foreach ($genrePopularity as $genreId => $genrePopularityBrand) {
            foreach ($genrePopularityBrand as $brand => $popularity) {
                $genrePatches[$genreId] = [
                    "popularity.$brand" => $popularity,
                ];
            }
        }
        $sanityGateway->patchSetMany($genrePatches);

        $artistPatches = [];
        foreach ($artistPopularity as $artistId => $artistPopularityBrand) {
            foreach ($artistPopularityBrand as $brand => $popularity) {
                $artistPatches[$artistId] = [
                    "popularity.$brand" => $popularity,
                ];
            }
        }
        $sanityGateway->patchSetMany($artistPatches);


        $this->info("Finished updating popularity results in Sanity.io");
    }

    public
    function getPopularityData(
        string $startDate
    ): array {
        $this->info("Calculating popularity results");

        $max = Content::query()->max('id');
        $chunk = 1000;
        $minId = 1;
        $maxId = $minId + $chunk;
        $popularityData = [];
        while ($minId < $max) {
            $weights = DB::table('railcontent_user_content_progress')->selectRaw(
                "IFNULL(SUM(CASE WHEN state = 'completed' THEN 1 ELSE 0 END), 0)*5 +
                     IFNULL(SUM(CASE WHEN state = 'started' THEN 1 ELSE 0 END), 0) as weight,
                    content_id"
            )->where('content_id', '>=', $minId)
                ->where('content_id', '<', $maxId)
                ->where('updated_on', '>', $startDate)
                ->groupBy('content_id')
                ->get();
            foreach ($weights as $weight) {
                $popularityData[] = ['id' => $weight->content_id, 'value' => $weight->weight];
            }

            $minId += $chunk;
            $maxId += $chunk;
            $this->info("content:updatePopularityMWP: Updating Content Progress to $minId/$max");
            usleep(1000);
        }
        $count = count($popularityData);
        $this->info("Calculated $count popularity results");

        return $popularityData;
    }
}
