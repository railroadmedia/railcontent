<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentData;
use App\Modules\Content\Models\ContentPermissions;
use App\Modules\Content\Models\ContentStyle;
use App\Modules\Content\Models\ContentUserProgress;
use App\Modules\Content\Models\Permission;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GenerateFileForSongMigrationInSanity extends Command
{
    protected $signature = 'content:GenerateFileForSongMigrationInSanity {brand=drumeo}';
    protected $description = 'GenerateFileForSongMigrationInSanity';

    protected $difficultyMapping = ['All', 'Novice', 'Beginner', 'Beginner', 'Intermediate', 'Intermediate', 'Advanced', 'Advanced', 'Expert', 'Expert','Expert'];

    public function handle()
    {
        $permissionsRailcontent = Permission::query()->get();
        $permissions = [];
        foreach ($permissionsRailcontent as $permission) {
            $name =  preg_replace('/[^a-zA-Z0-9_.]/', '', $permission->name);
            $id = 'permission_'.strtolower($name);
            $permissions[$id] = [
                '_id' => $id,
                'name' => $permission->name,
                '_type' => 'permission',
                'brand' => $permission->brand,
                'railcontent_id' => $permission->id,
            ];
        }

        $filename = resource_path() . '/sanitystudio/permissions.ndjson';
        foreach ($permissions as $result) {
            $newline = json_encode($result) . "\n";
            file_put_contents($filename, $newline, FILE_APPEND);
        }


        $genreData = ContentStyle::query()
            ->leftJoin('genre', 'genre.name', '=', 'railcontent_content_styles.style')
            ->selectRaw('distinct(railcontent_content_styles.style) as name, "genre" as type,
            COALESCE(genre.head_shot_picture_url, "https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/bf73168e-0d5f-476c-e819-d5c6ebb29900/public")
            AS thumbnail_url')->get();
        $genre = [];
        foreach ($genreData as $genreDatum) {
            $name =  preg_replace('/[^a-zA-Z0-9_.]/', '', $genreDatum->name);

            $id = 'genre_'.strtolower($name);
            $genre[$id] = [
                '_id' => $id,
                'name' => $genreDatum->name,
                '_type' => $genreDatum->type,
                'thumbnail_url' => ['_type' => 'image',
                                    '_sanityAsset' => 'image@'.$genreDatum->thumbnail_url
                ],
            ];
        }

        $filename = resource_path() . '/sanitystudio/genre.ndjson';
        foreach ($genre as $result) {
            $newline = json_encode($result) . "\n";
            file_put_contents($filename, $newline, FILE_APPEND);
        }

        $artistsData = Content::query()
            ->leftJoin('artists', 'artists.name', '=', 'railcontent_content.artist')
            ->where('railcontent_content.type', '=', 'song')
            ->selectRaw('distinct(railcontent_content.artist) as name, "artist" as type,
            COALESCE(artists.head_shot_picture_url, "https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/bf73168e-0d5f-476c-e819-d5c6ebb29900/public")
            AS thumbnail_url')->get();
        $artists = [];
        foreach ($artistsData as $artistsDatum) {
            $name =  preg_replace('/[^a-zA-Z0-9_]/', '', $artistsDatum->name);
            $id = 'artist_'.strtolower($name);
            $cleaned_name = preg_replace('/[é]/u', 'e', $artistsDatum->name);
            $artists[$id] = [
                '_id' => $id,
                'name' => preg_replace('/[^a-zA-Z0-9_ \-&.\'()\/ +!,]/', '', $cleaned_name),
                '_type' => $artistsDatum->type,
                'thumbnail_url' => ['_type' => 'image',
                                    '_sanityAsset' => 'image@'.$artistsDatum->thumbnail_url
                ],
            ];
        }

        $filename = resource_path() . '/sanitystudio/artists.ndjson';

        foreach ($artists as $result) {
            $newline = json_encode($result) . "\n";
            file_put_contents($filename, $newline, FILE_APPEND);
        }

        $results = Content::query()
            ->join('railcontent_content_hierarchy as hierarchy', 'hierarchy.parent_id', '=', 'railcontent_content.id')
            ->join('railcontent_content_fields as f', 'f.content_id', '=', 'hierarchy.child_id')
            ->where(
                'f.key',
                '=',
                'soundslice_slug'
            )
            ->join('railcontent_content_data as d', 'd.content_id', '=', 'railcontent_content.id')
            ->where(
                'd.key',
                '=',
                'thumbnail_url'
            )
            ->where('railcontent_content.type', '=', 'song')
            ->where('railcontent_content.status', '!=', 'deleted')
            ->where('railcontent_content.brand', '=', $this->argument('brand'))
            // ->where('railcontent_content.id','=',407287)
            ->selectRaw('railcontent_content.*, f.value as soundslice, d.value as thumb')->get();
        $songs = [];
        //   dd($results);
        foreach($results as $result) {
            if(in_array($result->id, [270443, 318625, 382515, 382827, 382765, 382767, 391008, 396548, 399638, 404279, 404299,
                382879, 391008, 391160, 401415, 378258, 381186])) {
                continue;
            }

            $artistName =  preg_replace('/[^a-zA-Z0-9_]/', '', $result->artist);
            $id = 'song_'.$result->id;
            $album =  preg_replace('/[^a-zA-Z0-9_]/', ' ', $result->album);
            $transcriber =  preg_replace('/[^a-zA-Z0-9_]/', ' ', $result->transcriber_name);
            $difficulty = (int)$result->difficulty;
            $songs[$id] = [
                '_id' => $id,
                '_type' => $result->type,
                'title' => $result->title,
                'slug' =>   ['_type' => 'slug',
                             'current' => $result->slug
                ],
                'brand' => $result->brand,
                'difficulty' => $difficulty,
                'railcontent_id' => $result->id,
                'language' => 'en-US',
                'album' => $album,
                'transcriber_name' => $transcriber,
                'xp' => (int)$result->xp,
                'total_xp' => (int)$result->total_xp,
                'released' => (int)$result->released,
                'child_count' => (int)$result->child_count,
                'published_on' => $result->published_on,
                'instrumentless' => $result->instrumentless == 1,
                'show_in_new_feed' => $result->show_in_new_feed == 1,
                'thumbnail' => ['_type' => 'image',
                                '_sanityAsset' => 'image@'.$result->thumb
                ],
                'soundslice' => [
                    [
                        'soundslice_title' => $result->title,
                        'soundslice_slug' => $result->soundslice,
                        'soundslice_length_in_second' => (int) $result->length_in_seconds]
                ],
                "web_url_path" => '/'.$result->brand.'/songs/'. $result->slug.'/'. $result->id,
                "popularity" => $result->popularity
            ];
            if(isset($this->difficultyMapping[$difficulty])) {
                $songs[$id]["difficulty_string"] = $this->difficultyMapping[$difficulty];
            }
            if(isset($artists['artist_'.strtolower($artistName)])) {
                $songs[$id]["artist"] = [
                    "_type" => "reference",
                    "_ref" => 'artist_'.strtolower($artistName), // Replace with the actual artist ID
                    "_weak" => false
                ];
            }

            $genreC = ContentStyle::query()->where('content_id', '=', $result->id)->get();
            foreach ($genreC as $genreDatum) {
                $name =  preg_replace('/[^a-zA-Z0-9_.]/', '', $genreDatum->style);
                if(isset($genre['genre_'.strtolower($name)])) {
                    $songs[$id]["genre"][] = [
                        "_type" => "reference",
                        "_ref"  => 'genre_'.strtolower($name), // Replace with the actual artist ID
                        "_weak" => false
                    ];
                }
            }

            $contentData = ContentData::query()->where('content_id', '=', $result->id)->whereIn('key', ['resource_name', 'resource_url'])->get();
            $resources = [];
            foreach($contentData as $datum) {
                $resources[$datum->position][$datum->key] = $datum->value;
            }
            foreach($resources as $resource) {
                if(isset($resource['resource_name']) && isset($resource['resource_url'])) {
                    $songs[$id]["resource"][] = [
                        'resource_name' => $resource['resource_name'],
                        'resource_url'  => $resource['resource_url']
                    ];
                }
            }

            $contentPermissions = ContentPermissions::with('permissions')->where('content_id', '=', $result->id)->get();

            foreach ($contentPermissions as $contentPermission) {
                $name =  preg_replace('/[^a-zA-Z0-9_.]/', '', $contentPermission->permissions->name);
                if(isset($permissions['permission_'.strtolower($name)])) {
                    $songs[$id]["permission"][] = [
                        "_type" => "reference",
                        "_ref"  => 'permission_'.strtolower($name),
                        "_weak" => false
                    ];
                }
            }
        }

        $filename = resource_path() . '/sanitystudio/songs.ndjson';

        foreach ($songs as $result) {
            $newline = json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n";
            file_put_contents($filename, $newline, FILE_APPEND);
        }
    }
}
