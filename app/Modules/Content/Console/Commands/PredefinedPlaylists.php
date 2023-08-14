<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\Models\UserPlaylist;
use App\Modules\Content\Models\UserPlaylistContent;
use Exception;

class PredefinedPlaylists extends Command
{
    protected $name = 'PredefinedPlaylists';
    protected $signature = 'predefinedPlaylists {startIndex=0} {endIndex=-1}';
    protected $description = 'Create pre-defined playlists';

    public function handle()
    {
        $startIndex = $this->argument('startIndex');
        $endIndex = $this->argument('endIndex');

        [$csv, $headersRow] = $this->getCSV($startIndex, $endIndex);

        $this->withProgressBar($csv, function ($row) use ($headersRow, &$contentIds) {
            $data = $this->getData($row, $headersRow);
            $contentId = $this->getValue($data, $headersRow, 'id');

            $playlist = new UserPlaylist();
            $playlist->brand = $this->getValue($data, $headersRow, 'brand');
            $playlist->type = $this->getValue($data, $headersRow, 'type');
            $playlist->user_id = $this->getValue($data, $headersRow, 'user_id');
            $playlist->created_at = $this->getValue($data, $headersRow, 'created_at');
            $playlist->name = $this->getValue($data, $headersRow, 'name');
            $playlist->description = $this->getValue($data, $headersRow, 'description');
            $playlist->thumbnail_url = $this->getValue($data, $headersRow, 'thumbnail_url');
            $playlist->category = $this->getValue($data, $headersRow, 'category');
            $playlist->private = $this->getValue($data, $headersRow, 'private');
            $playlist->duration = $this->getValue($data, $headersRow, 'duration');
            $playlist->save();

            $lessons = $this->getValue($data, $headersRow, 'lessons');
            $lessonIds = array_map('trim', explode(',', $lessons));
            $extraData = $this->getValue($data, $headersRow, 'extra_data');

            if ($extraData != 'NULL') {
                $extra = array_map('trim', explode(',', $extraData));
            }
            foreach ($lessonIds as $key => $lessonId) {
                $userPlaylistContent = new UserPlaylistContent();
                $userPlaylistContent->user_playlist_id = $playlist->id;
                $userPlaylistContent->content_id = $lessonId;
                $userPlaylistContent->position = ($key + 1);
                $userPlaylistContent->created_at = $playlist->created_at;
                if (isset($extra[$key])) {
                    $userPlaylistContent->extra_data = $extra[$key];
                }
                $userPlaylistContent->save();
            }

            $this->info(
                "Created playlist with beta id $contentId - prod id $playlist->id  url: ".
                url()->route('platform.user.playlist', ['id' => $playlist->id, 'brand' => $playlist->brand])
            );
        });

        $this->info('Done.');
    }

    public function getCSV(int $startIndex, int $endIndex)
    : array {
        $fileName = 'predefined-playlists.csv';
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
