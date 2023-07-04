<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\Models\Content;
use Exception;
use Illuminate\Support\Facades\DB;

class ImportSongsDuration extends Command
{

    protected $name = 'ImportSongsDuration';
    protected $signature = 'ImportSongsDuration {brand=drumeo} {calculateduration=0} {startIndex=0} {endIndex=-1}';
    protected $description = 'Import songs duration from csv file';

    public function handle()
    {
        $startIndex = $this->argument('startIndex');
        $endIndex = $this->argument('endIndex');
        $brand = $this->argument('brand');
        $calculateDuration = $this->argument('calculateduration', false);

        [$csv, $headersRow] = $this->getCSV($startIndex, $endIndex, $brand);

        $this->withProgressBar($csv, function ($row) use ($headersRow, &$contentIds, $calculateDuration) {
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
                $playlists =
                    DB::table('railcontent_user_playlist_content')
                        ->selectRaw('user_playlist_id ')
                        ->where('content_id', '=', $songId)
                        ->get();
                foreach ($playlists->pluck('user_playlist_id') as $playlistId) {
                    $playlistDuration =
                        \DB::table('railcontent_user_playlists')
                            ->where('railcontent_user_playlists.id', '=', $playlistId)
                            ->update([
                                         'duration' => DB::raw('IFNULL(duration, 0) +'.$duration),
                                     ]);
                }
            }
        });

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
