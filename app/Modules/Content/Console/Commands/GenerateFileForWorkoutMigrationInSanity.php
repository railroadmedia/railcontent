<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentData;
use App\Modules\Content\Models\ContentHierarchy;
use App\Modules\Content\Models\ContentInstructor;
use App\Modules\Content\Models\ContentPermissions;
use App\Modules\Content\Models\ContentStyle;
use App\Modules\Content\Models\ContentUserProgress;
use App\Modules\Content\Models\Permission;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Content\Models\ContentCreativity;
use Modules\Content\Models\ContentEssentials;
use Modules\Content\Models\ContentGenre;
use Modules\Content\Models\ContentLifestyle;
use Modules\Content\Models\ContentTheory;
use Modules\Content\Models\ContentTopic;

class GenerateFileForWorkoutMigrationInSanity extends ImportSanityDataset
{
    protected $signature = 'content:GenerateFileForWorkoutMigrationInSanity {brand=drumeo} {type=song} {delete=false}';
    protected $description = 'GenerateFileForWorkoutMigrationInSanity';

    protected $difficultyMapping = ['All', 'Novice', 'Beginner', 'Beginner', 'Intermediate', 'Intermediate', 'Advanced', 'Advanced', 'Expert', 'Expert','Expert'];

    public function handle():int
    {
        $contentType = $this->argument('type');
        $deleteOldDocuments = $this->argument('delete');
        $extraModels = [
            'lifestyle' => ContentLifestyle::class,
            'essential' => ContentEssentials::class,
            'creativity' => ContentCreativity::class,
            'theory' => ContentTheory::class,
            'topic' => ContentTopic::class,
            'genre' => ContentGenre::class
        ];
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

        $instructorsData = Content::with('data')
            ->where('type','=','instructor')
            ->where('railcontent_content.status', '=', 'published')
            ->get();

        $instructors = [];
        foreach ($instructorsData as $instructorDatum){
            $name =  preg_replace('/[^a-zA-Z0-9_]/', '', $instructorDatum->name);

            $id = 'instructor_'.strtolower($name);
            $thumb = '';
            foreach ($instructorDatum['data'] as $info){
                if($info['key'] == 'head_shot_picture_url'){
                    $thumb = $info['value'];
                }
            }

            $instructors[$id] = [
                '_id' => $id,
                'name' => $instructorDatum->name,
                '_type' => $instructorDatum->type
            ];
            if($thumb != ''){
                $instructors[$id]['thumbnail_url' ]= ['_type' =>'image',
                                                      '_sanityAsset' => 'image@'.$thumb
                ];
            }
        }

        $filename = resource_path() . '/sanitystudio/instructors.ndjson';
        foreach ($instructors as $result) {
            $newline = json_encode($result) . "\n";
            file_put_contents($filename, $newline, FILE_APPEND);
        }

        $extraData = [];
        foreach ($extraModels as $index=>$extraModel)
        {
            $model = new $extraModel();

            $allData = $model::query()
                ->get();
            $extraData[$index] = [];
        foreach ($allData as $datum){
            $columnName = $model->getName();
            $name =  preg_replace('/[^a-zA-Z0-9_]/', '', $datum->$columnName);
            $id = $index.'_'.strtolower($name);

            $extraData[$index][$id] = [
                '_id' => $id,
                'name' => $datum->$columnName,
                '_type' => $index
            ];
        }
            $filename = resource_path() . '/sanitystudio/'.$index.'.ndjson';
        foreach ($extraData[$index] as $result) {
            $newline = json_encode($result) . "\n";
            file_put_contents($filename, $newline, FILE_APPEND);
        }
        }

        $results = Content::with('data','fields')->where('railcontent_content.type', '=', $contentType)
            ->where('railcontent_content.status', '!=', 'deleted')
            ->where('railcontent_content.brand', '=', $this->argument('brand'))
           // ->where('railcontent_content.id','=',190417)
            ->whereNotIn('railcontent_content.id',[402037,30437, 206255])->get();

        $songs = [];
        foreach($results as $result) {
            $id = $contentType.'_'.$result->id;
            $difficulty = (int)$result->difficulty;
            $songs[$id] = [
                '_id' => $id,
                '_type' => $result->type,
                'title' => $result->title,
                'sort' => (int)($result->sort ?? 0),
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
                "web_url_path" => '/'.$result->brand.'/'.$contentType.'/'. $result->slug.'/'. $result->id,
                "popularity" => $result->popularity
            ];
            if(isset($this->difficultyMapping[$difficulty])) {
                $songs[$id]["difficulty_string"] = $this->difficultyMapping[$difficulty];
            }
            $resources = [];
            $chapters = [];
            foreach($result->data as $datum) {
                if($datum['key'] == 'thumbnail_url' && $datum['value'] != ''){
                    $songs[$id]['thumbnail'] = ['_type' => 'image',
                                '_sanityAsset' => 'image@'.$datum['value']
                ];
                }
                if($datum['key'] == 'resource_name'){
                    $resources[$datum['position']]['resource_name'] = $datum['value'];
                }
                if($datum['key'] == 'resource_url'){
                    $resources[$datum['position']]['resource_url'] = $datum['value'];
                }
                if($datum['key'] == 'chapter_timecode'){
                    $chapters[$datum['position']]['chapter_timecode'] = $datum['value'];
                }
                if($datum['key'] == 'chapter_description'){
                    $chapters[$datum['position']]['chapter_description'] = $datum['value'];
                }
                if($datum['key'] == 'chapter_thumbnail_url'){
                    $chapters[$datum['position']]['chapter_thumbnail_url'] = $datum['value'];
                }
                if($datum['key'] == 'description'){
//                    $songs[$id]['description'][] = ['_type' => 'block',
//                        "style"=> "normal",
//                                                  'children' => [
//                                                      '_type' => 'span',
//                                                      "marks"=> [],
//                                                      'text'=>$datum['value']]
//                    ];
                }
            }
           // dd($result->fields);
            $songs[$id]['show_in_new_feed'] = false;
            $songs[$id]['is_featured'] = false;
            $songs[$id]['hide_from_recsys'] = false;
            $lifestyleContent = [];
            $creativityContent = [];
            $contentExtraData = [];
            foreach($result->fields as $field) {
                if($field['key'] == 'soundslice_slug'){
                    $songs[$id]['soundslice_slug'] = $field['value'];
                }
                if($field['key'] == 'show_in_new_feed'){
                    $songs[$id]['show_in_new_feed'] = ($field['value'] == 1);
                }
                if($field['key'] == 'is_featured'){
                    $songs[$id]['is_featured'] = ($field['value'] == 1);
                }
                if($field['key'] == 'hide_from_recsys'){
                    $songs[$id]['hide_from_recsys'] = ($field['value'] == 1);
                }

                if(array_key_exists($field['key'], $extraModels) || ($field['key'] == 'essentials')){
                    $contentExtraData[$field['key']][] = $field['value'];
                }
                if(($field['key'] == 'essentials')){
                    $contentExtraData['essential'][] = $field['value'];
                }

            }

            foreach($resources as $resource) {
                if(isset($resource['resource_name']) && isset($resource['resource_url'])) {
                    $songs[$id]["resource"][] = [
                        'resource_name' => $resource['resource_name'],
                        'resource_url'  => $resource['resource_url']
                    ];
                }
            }

            foreach($chapters as $chapter) {

                    if(isset($chapter['chapter_thumbnail_url']) && $chapter['chapter_thumbnail_url'] != ''){
                        $songs[$id]["chapter"][]=
                        ['chapter_timecode' => (integer)($chapter['chapter_timecode'] ?? 0),
                         'chapter_description'  => $chapter['chapter_description'],
                         'chapter_thumbnail_url' => ['_type' => 'image',
                                                     '_sanityAsset' => 'image@'.$chapter['chapter_thumbnail_url']
                         ]];
                    }else{
                        $songs[$id]["chapter"][] = [
                            'chapter_timecode' => (integer)($chapter['chapter_timecode'] ?? 0),
                            'chapter_description'  => $chapter['chapter_description'],
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
            if(!empty($contentExtraData)) {
                foreach ($contentExtraData as $index=>$contentExtra) {
                    foreach ($contentExtra as $contentExtraDatum){
                        $name = preg_replace('/[^a-zA-Z0-9_]/', '', $contentExtraDatum);
                        if(isset($extraData[$index][$index.'_'.strtolower($name)])) {

                        $songs[$id]["$index"][] = [
                            "_type" => "reference",
                            "_ref"  => $index.'_'.strtolower($name),
                            "_weak" => false
                        ];
                    }
                    }
                }
            }
            $contentInstructors = ContentInstructor::with('instructor')->where('content_id', '=', $result->id)->get();
            foreach ($contentInstructors as $contentInstructor) {
                $name =  preg_replace('/[^a-zA-Z0-9_]/', '', $contentInstructor->instructor->name);
                if(isset($instructors['instructor_'.strtolower($name)])) {
                    $songs[$id]["instructor"][] = [
                        "_type" => "reference",
                        "_ref"  => 'instructor_'.strtolower($name),
                        "_weak" => false
                    ];
                }
            }

            $contentHierarchy = ContentHierarchy::with('child')->where('parent_id', '=', $result->id)->get();
            foreach($contentHierarchy as $hierarchy){
                if($hierarchy->child->type != 'assignment' && $hierarchy->child->status == 'published') {
                    $songs[$id]["child"][] = [
                        "_type" => "reference",
                        "_ref"  => $hierarchy->child->type . '_' . $hierarchy->child->id,
                        "_weak" => false
                    ];
                }else{
                    $songs[$id]["assignment"][] = [
                        'assignment_title' => $hierarchy->child->title,
                        'assignment_soundslice'  => $hierarchy->child->soundslice_slug,
                        'assignment_description' =>'',
                        'assignment_sheet_music_image' => ''
                    ];
                }
               // dd($hierarchy->child->type, $hierarchy->child->title, $hierarchy->child->id);
            }
        }
        $directory = 'resources/sanitystudio';
        $filename1 = "instructors.ndjson";
        $filename = "workouts.ndjson";
        // import into the destination

        if($deleteOldDocuments  == "true") {
            $ids        = implode(' ', array_keys($songs));
            $resultCode = $this->runCliCommand("cd $directory && yarn sanity documents delete --dataset=development " . $ids);
        }
        $filename = resource_path() . '/sanitystudio/workouts.ndjson';

        foreach ($songs as $result) {
            $newline = json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n";
            file_put_contents($filename, $newline, FILE_APPEND);
        }
        return 1;
    }
}
