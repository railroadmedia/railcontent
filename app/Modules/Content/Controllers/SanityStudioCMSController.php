<?php

namespace App\Modules\Content\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\Sanity\CatalogMetadata;
use App\Modules\Content\Models\Sanity\CoachStream;
use App\Modules\Content\Models\Sanity\Foundation;
use App\Modules\Content\Models\Sanity\Method;
use App\Modules\Content\Models\Sanity\Pack;
use App\Modules\Content\Models\Sanity\SemesterPack;
use App\Modules\Content\Models\Sanity\Shows\Archive;
use App\Modules\Content\Models\Sanity\Artist;
use App\Modules\Content\Models\Sanity\Shows\BackstageSecret;
use App\Modules\Content\Models\Sanity\Shows\BehindTheScenes;
use App\Modules\Content\Models\Sanity\Shows\BootCamp;
use App\Modules\Content\Models\Sanity\Challenge;
use App\Modules\Content\Models\Sanity\ChallengePart;
use App\Modules\Content\Models\Sanity\Shows\Challenges;
use App\Modules\Content\Models\Sanity\Course;
use App\Modules\Content\Models\Sanity\CoursePart;
use App\Modules\Content\Models\Sanity\Creativity;
use App\Modules\Content\Models\Sanity\Shows\Diy;
use App\Modules\Content\Models\Sanity\Shows\DrumFestInternational2022;
use App\Modules\Content\Models\Sanity\Enums\Workspace;
use App\Modules\Content\Models\Sanity\Shows\ExploringBeats;
use App\Modules\Content\Models\Sanity\Shows\GearGuide;
use App\Modules\Content\Models\Sanity\Genre;
use App\Modules\Content\Models\Sanity\Shows\InRhythm;
use App\Modules\Content\Models\Sanity\Instructor;
use App\Modules\Content\Models\Sanity\Lifestyle;
use App\Modules\Content\Models\Sanity\Shows\Live;
use App\Modules\Content\Models\Sanity\Shows\OnTheRoad;
use App\Modules\Content\Models\Sanity\Shows\Performance;
use App\Modules\Content\Models\Sanity\Permission;
use App\Modules\Content\Models\Sanity\PlayAlong;
use App\Modules\Content\Models\Sanity\Shows\Podcast;
use App\Modules\Content\Models\Sanity\Shows\QuestionAndAnswer;
use App\Modules\Content\Models\Sanity\QuickTip;
use App\Modules\Content\Models\Sanity\Shows\RhythmicAdventuresOfCaptainCarson;
use App\Modules\Content\Models\Sanity\Routine;
use App\Modules\Content\Models\Sanity\Rudiment;
use App\Modules\Content\Models\Sanity\Shows\Solo;
use App\Modules\Content\Models\Sanity\Song;
use App\Modules\Content\Models\Sanity\Essential;
use App\Modules\Content\Models\Sanity\SongTutorial;
use App\Modules\Content\Models\Sanity\Shows\Sonor;
use App\Modules\Content\Models\Sanity\Shows\Spotlight;
use App\Modules\Content\Models\Sanity\Shows\StudentCollaboration;
use App\Modules\Content\Models\Sanity\StudentFocus;
use App\Modules\Content\Models\Sanity\Shows\StudyTheGreats;
use App\Modules\Content\Models\Sanity\Shows\Tama;
use App\Modules\Content\Models\Sanity\Shows\TheHistoryOfElectronicDrums;
use App\Modules\Content\Models\Sanity\Shows\RhythmsFromAnotherPlanet;
use App\Modules\Content\Models\Sanity\Shows\PaisteCymbals;
use App\Modules\Content\Models\Sanity\Theory;
use App\Modules\Content\Models\Sanity\Topic;
use App\Modules\Content\Models\Sanity\Venue;
use App\Modules\Content\Models\Sanity\Workout;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Modules\Content\Models\Sanity\License;
use App\Modules\Content\Models\Sanity\Publisher;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Services\PermissionService;

class SanityStudioCMSController extends BaseController
{
    public function renderStudio(Request $request): Response
    {
        // common settings
        $projectId = config('content.project_id');
        $dataset = config('content.dataset');
        $csrfToken = csrf_token();
        $appUrl = env('APP_URL');

        // publishing workspace
        $types = [
            (new Challenge())->toArray(),
            (new ChallengePart())->toArray(),
            (new Workout())->toArray(),
            (new Song())->toArray(),
            (new Course())->toArray(),
            (new CoursePart())->toArray(),
            (new QuickTip())->toArray(),
            (new BootCamp())->toArray(),
            (new StudentFocus())->toArray(),
            (new PlayAlong())->toArray(),
            (new Rudiment())->toArray(),
            (new DrumFestInternational2022())->toArray(),
            (new Spotlight())->toArray(),
            (new TheHistoryOfElectronicDrums())->toArray(),
            (new BackstageSecret())->toArray(),
            (new QuestionAndAnswer())->toArray(),
            (new StudentCollaboration())->toArray(),
            (new Live())->toArray(),
            (new Podcast())->toArray(),
            (new Solo())->toArray(),
            (new GearGuide())->toArray(),
            (new Performance())->toArray(),
            (new InRhythm())->toArray(),
            (new Challenges())->toArray(),
            (new OnTheRoad())->toArray(),
            (new Diy())->toArray(),
            (new RhythmicAdventuresOfCaptainCarson())->toArray(),
            (new StudyTheGreats())->toArray(),
            (new RhythmsFromAnotherPlanet())->toArray(),
            (new Tama())->toArray(),
            (new PaisteCymbals())->toArray(),
            (new BehindTheScenes())->toArray(),
            (new ExploringBeats())->toArray(),
            (new Sonor())->toArray(),
            (new Routine())->toArray(),
            (new CoachStream())->toArray(),
            (new SemesterPack())->toArray(),
            (new Pack())->toArray(),
            (new Method())->toArray(),
            (new SongTutorial())->toArray(),
            (new Foundation())->toArray(),
            (new Archive())->toArray(),
            (new Artist())->toArray(),
            (new Genre())->toArray(),
            (new Permission())->toArray(),
            (new Topic())->toArray(),
            (new Essential())->toArray(),
            (new Creativity())->toArray(),
            (new Theory())->toArray(),
            (new Lifestyle())->toArray(),
            (new Instructor())->toArray(),
            (new License())->toArray(),
            (new Publisher())->toArray(),
            (new CatalogMetadata())->toArray(),
        ];

        $publishing = [
            'projectId' => $projectId,
            'dataset' => $dataset,
            'name' => Workspace::Publishing->workspaceName(),
            'basePath' => Workspace::Publishing->basePath(),
            'title' => Workspace::Publishing->title(),
            'icon' => Workspace::Publishing->icon(),
            'schema' => json_encode([
                'types' => $types
            ])
        ];

        // marketing workspace
        // TODO Nataliia to add new types here in place of Venue
        $types = [(new Venue())->toArray()];
        $marketing = [
            'projectId' => $projectId,
            'dataset' => $dataset,
            'name' => Workspace::Marketing->workspaceName(),
            'basePath' => Workspace::Marketing->basePath(),
            'title' => Workspace::Marketing->title(),
            'icon' => Workspace::Marketing->icon(),
            'schema' => json_encode([
                'types' => $types
            ])
        ];

        $workspaces = [
            $marketing,
            $publishing
        ];

        return response()->view(
            "content::sanity-studio-cms-index",
            compact([
                'workspaces',
                'csrfToken',
                'appUrl'
            ])
        );
    }

    public function getSoundsliceDuration(Request $request)
    {
        $slug = $request->get('slug');
        try {
            $client = new \GuzzleHttp\Client();
            $auth = [env('SOUNDSLICE_APP_ID'), env('SOUNDSLICE_SECRET')];
            $response = $client->request('GET', 'https://www.soundslice.com/'.'api/v1/slices/'.$slug.'/recordings', [
                'auth' => $auth,
            ]);

            $body = json_decode($response->getBody(), true);
            $duration = 0;
            if (!empty($body)) {
                $duration = \Arr::last($body)['cropped_duration'] ?? \Arr::first($body)['cropped_duration'] ?? 0;
            }
        } catch (\Exception $e) {
            return 0;
        }
        return $duration;
    }

    public function getLastContent(Request $request): array|Content
    {
        if ($request->get('_type') === 'permission') {
            $permissionService = app()->make(PermissionService::class);
            $permission = $permissionService->getByName($request->get('name'));
            if(!$permission) {
                $permission = $permissionService->create($request->get('name'), $request->get('brand'));
            }
            return $permission;
        }else {
            if($request->has('railcontent_id')){
                $content = Content::query()
                    ->where('type', '=', $request->get('_type'))
                    ->where('id', '=', $request->get('railcontent_id'))
                    ->first();
            }else {
                $content = Content::query()
                    ->where('type', '=', $request->get('_type'))
                    ->where('slug', '=', $request->get('slug')['current'])
                    ->first();
            }

            if (!$content) {
                $content             = new Content();
                $content->type       = $request->get('_type');
                $content->slug       = $request->has('slug') ? $request->get('slug')['current'] : null;
                $content->language   = 'en-US';
                $content->created_on = Carbon::now()->toDateTimeString();
                $content->status     = 'published';
                $content->brand      = $request->get('brand');

                $content->save();
            }

            $content->status = 'published';
            $content->brand  = $request->get('brand');
            $content->slug       = $request->has('slug') ? $request->get('slug')['current'] : null;
            $content->setTitle($request->get('title'));
            $content->setDifficulty($request->get('difficulty'));
            $content->setXP($request->get('xp'));
            $content->setReleased($request->get('released'));
            $content->setAlbum($request->get('album'));

            $content->save();

            event(new ContentCreated($content->id));

            //need to pull again content for the web_url_path
            $content = Content::query()
                ->where('id', '=',$content->id)
                ->first();

            return $content;
        }
    }
}
