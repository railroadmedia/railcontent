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

class GenerateFileForWorkoutMigrationInSanity extends Command
{
    protected $signature = 'content:GenerateFileForWorkoutMigrationInSanity {brand=drumeo}';
    protected $description = 'GenerateFileForWorkoutMigrationInSanity';

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

        $results = Content::query()
            ->join('railcontent_content_fields as f', 'f.content_id', '=', 'railcontent_content.id')
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
            ->where('railcontent_content.type', '=', 'workout')
            ->where('railcontent_content.status', '!=', 'deleted')
            ->where('railcontent_content.brand', '=', $this->argument('brand'))
             ->where('railcontent_content.id','=',405617)
            ->selectRaw('railcontent_content.*, f.value as soundslice, d.value as thumb')->get();
        $songs = [];
        foreach($results as $result) {
            $id = 'workout_'.$result->id;
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
                'xp' => (int)$result->xp,
                'total_xp' => (int)$result->total_xp,
                'published_on' => $result->published_on,
                'show_in_new_feed' => $result->show_in_new_feed == 1,
                'thumbnail' => ['_type' => 'image',
                                '_sanityAsset' => 'image@'.$result->thumb
                ],
                'soundslice_slug' => $result->soundslice,
                "web_url_path" => '/'.$result->brand.'/songs/'. $result->slug.'/'. $result->id,
                "popularity" => $result->popularity
            ];
            if(isset($this->difficultyMapping[$difficulty])) {
                $songs[$id]["difficulty_string"] = $this->difficultyMapping[$difficulty];
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

        $filename = resource_path() . '/sanitystudio/workouts.ndjson';

        foreach ($songs as $result) {
            $newline = json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n";
            file_put_contents($filename, $newline, FILE_APPEND);
        }
    }
}
