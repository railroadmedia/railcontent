<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\Models\Content;
use Exception;
use Illuminate\Support\Facades\DB;

class ImportSongsDuration extends Command
{

    protected $name = 'ImportSongsDuration';
    protected $signature = 'ImportSongsDuration {brand=drumeo} {calculateduration=0} {startIndex=0}';
    protected $description = 'Import songs duration from csv file';

    public function handle()
    {
        $startIndex = $this->argument('startIndex');
        $brand = $this->argument('brand');
        $calculateDuration = $this->argument('calculateduration', false);

        [$csv, $headersRow] = $this->getCSV(0, -1, $brand);
        $playlists = [];
        $this->withProgressBar($csv, function ($row) use ($headersRow, &$contentIds, $calculateDuration, &$playlists) {
            $data = $this->getData($row, $headersRow);
            $songId = $this->getValue($data, $headersRow, 'id');
            $contentId = $this->getValue($data, $headersRow, 'assignment_id');
            $duration = $this->getValue($data, $headersRow, 'length_in_seconds');

            $content =
                Content::query()
                    ->where('id', '=', $contentId)
                    ->first();
            if (!$content) {
                $this->error("Content $contentId not found");
            } else {
                $content->length_in_seconds = $duration;
                $content->save();
            }
            if ($calculateDuration == 1) {
                $playlists = array_merge(
                    $playlists,
                    DB::table('railcontent_user_playlist_content')
                        ->selectRaw('user_playlist_id ')
                        ->where('content_id', '=', $songId)
                        ->get()
                        ->pluck('user_playlist_id')
                        ->toArray()
                );
                $playlists = array_unique($playlists);
            }
        });

        if ($calculateDuration == 1) {
            $total = 0;
            $chunks = array_chunk($playlists, $startIndex);

            $count = count($playlists);

            foreach ($chunks as $playlistIds) {
                foreach ($playlistIds as $playlistId) {
                    $total++;
                    // dd($playlistIds);
                    $duration =
                        DB::table('railcontent_content_fields')
                            ->selectRaw(
                                'sum(length_in_seconds) as duration'
                            )
                            ->join(
                                'railcontent_content',
                                'railcontent_content_fields.value',
                                '=',
                                'railcontent_content.id'
                            )
                            ->join(
                                'railcontent_user_playlist_content',
                                'railcontent_content_fields.content_id',
                                '=',
                                'railcontent_user_playlist_content.content_id'
                            )
                            ->whereIn('railcontent_user_playlist_content.user_playlist_id', [$playlistId])
                            ->where('railcontent_content_fields.key', '=', 'video')
                            ->orderBy('railcontent_content_fields.id', 'asc')
                            ->first();
                    $songDuration =
                        DB::table('railcontent_user_playlist_content')
                            ->selectRaw(
                                'sum(railcontent_content.length_in_seconds) as duration'
                            )
                            ->join(
                                'railcontent_content_hierarchy',
                                'railcontent_content_hierarchy.parent_id',
                                '=',
                                'railcontent_user_playlist_content.content_id'
                            )
                            ->join(
                                'railcontent_content',
                                'railcontent_content_hierarchy.child_id',
                                '=',
                                'railcontent_content.id'
                            )
                            ->whereIn('railcontent_user_playlist_content.user_playlist_id', [$playlistId])
                            ->where('railcontent_content.type', '=', 'assignment')
                            ->first();

                    $playlistDuration =
                        \DB::table('railcontent_user_playlists')
                            ->where('railcontent_user_playlists.id', '=', $playlistId)
                            ->update([
                                         'duration' => ($duration->duration ?? 0) + ($songDuration->duration ?? 0),
                                     ]);
                }
                $this->info('Playlists duration updated:::'.$total);
            }
            $this->info($total);
        }

        $this->info('Done.');
    }

    public function getCSV(int $startIndex, int $endIndex, $brand)
    : array {
        $fileName = $brand.'_songs_duration.csv';
        $filePath = app_path().'/Modules/Content/Console/Commands/Data/'.$fileName;
        $file = file($filePath);
        $csv = array_map('str_getcsv', $file);
        $headersRow = $csv[0];
        unset($csv[0]);
        if ($endIndex == -1 or $endIndex > count($csv)) {
            $endIndex = count($csv);
        }
        $csv = array_slice($csv, $startIndex, $endIndex - $startIndex);

        return [$csv, $headersRow];
    }

    private function getData($row, $headersRow)
    : array {
        $data = [];
        for ($i = 0; $i < count($row); $i++) {
            $data[$headersRow[$i]] = $row[$i];
        }

        return $data;
    }

    private function getValue(array $data, mixed $headersRow, string $name)
    : ?string {
        if (!in_array($name, $headersRow)) {
            throw new Exception("Header '$name' does not exist in array");
        }

        return $data[$name] ?? "";
    }
}
