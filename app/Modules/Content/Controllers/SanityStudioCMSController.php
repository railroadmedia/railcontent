<?php

namespace App\Modules\Content\Controllers;

use App\Decorators\Content\VimeoTrailerDecorator;
use App\Http\Controllers\BaseController;
use App\Maps\PrimaryURLSlugToContentTypeMap;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\Sanity\Artist;
use App\Modules\Content\Models\Sanity\CatalogMetadata;
use App\Modules\Content\Models\Sanity\Challenge;
use App\Modules\Content\Models\Sanity\ChallengeDropDownItem;
use App\Modules\Content\Models\Sanity\ChallengePart;
use App\Modules\Content\Models\Sanity\CoachStream;
use App\Modules\Content\Models\Sanity\Course;
use App\Modules\Content\Models\Sanity\CoursePart;
use App\Modules\Content\Models\Sanity\Creativity;
use App\Modules\Content\Models\Sanity\Enums\Workspace;
use App\Modules\Content\Models\Sanity\Essential;
use App\Modules\Content\Models\Sanity\Focus;
use App\Modules\Content\Models\Sanity\Foundation;
use App\Modules\Content\Models\Sanity\Genre;
use App\Modules\Content\Models\Sanity\Instructor;
use App\Modules\Content\Models\Sanity\License;
use App\Modules\Content\Models\Sanity\Lifestyle;
use App\Modules\Content\Models\Sanity\Method;
use App\Modules\Content\Models\Sanity\MethodCourse;
use App\Modules\Content\Models\Sanity\MethodLesson;
use App\Modules\Content\Models\Sanity\MethodLevel;
use App\Modules\Content\Models\Sanity\Pack;
use App\Modules\Content\Models\Sanity\PackBundle;
use App\Modules\Content\Models\Sanity\PackBundleLesson;
use App\Modules\Content\Models\Sanity\Permission;
use App\Modules\Content\Models\Sanity\PlayAlong;
use App\Modules\Content\Models\Sanity\PlayAlongPart;
use App\Modules\Content\Models\Sanity\Publisher;
use App\Modules\Content\Models\Sanity\QuickTip;
use App\Modules\Content\Models\Sanity\Routine;
use App\Modules\Content\Models\Sanity\Rudiment;
use App\Modules\Content\Models\Sanity\SemesterPack;
use App\Modules\Content\Models\Sanity\SemesterPackLesson;
use App\Modules\Content\Models\Sanity\Shows\Archive;
use App\Modules\Content\Models\Sanity\Shows\BackstageSecret;
use App\Modules\Content\Models\Sanity\Shows\BehindTheScenes;
use App\Modules\Content\Models\Sanity\Shows\BootCamp;
use App\Modules\Content\Models\Sanity\Shows\Challenges;
use App\Modules\Content\Models\Sanity\Shows\Diy;
use App\Modules\Content\Models\Sanity\Shows\DrumFestInternational2022;
use App\Modules\Content\Models\Sanity\Shows\ExploringBeats;
use App\Modules\Content\Models\Sanity\Shows\GearGuide;
use App\Modules\Content\Models\Sanity\Shows\InRhythm;
use App\Modules\Content\Models\Sanity\Shows\Live;
use App\Modules\Content\Models\Sanity\Shows\OddTimes;
use App\Modules\Content\Models\Sanity\Shows\OnTheRoad;
use App\Modules\Content\Models\Sanity\Shows\PaisteCymbals;
use App\Modules\Content\Models\Sanity\Shows\Performance;
use App\Modules\Content\Models\Sanity\Shows\Podcast;
use App\Modules\Content\Models\Sanity\Shows\QuestionAndAnswer;
use App\Modules\Content\Models\Sanity\Shows\RhythmicAdventuresOfCaptainCarson;
use App\Modules\Content\Models\Sanity\Shows\RhythmsFromAnotherPlanet;
use App\Modules\Content\Models\Sanity\Shows\Solo;
use App\Modules\Content\Models\Sanity\Shows\Sonor;
use App\Modules\Content\Models\Sanity\Shows\Spotlight;
use App\Modules\Content\Models\Sanity\Shows\StudentCollaboration;
use App\Modules\Content\Models\Sanity\Shows\StudyTheGreats;
use App\Modules\Content\Models\Sanity\Shows\Tama;
use App\Modules\Content\Models\Sanity\Shows\TheHistoryOfElectronicDrums;
use App\Modules\Content\Models\Sanity\Song;
use App\Modules\Content\Models\Sanity\SongTutorial;
use App\Modules\Content\Models\Sanity\SongTutorialChildren;
use App\Modules\Content\Models\Sanity\StudentFocus;
use App\Modules\Content\Models\Sanity\Theory;
use App\Modules\Content\Models\Sanity\Topic;
use App\Modules\Content\Models\Sanity\Unit;
use App\Modules\Content\Models\Sanity\UnitPart;
use App\Modules\Content\Models\Sanity\Venue;
use App\Modules\Content\Models\Sanity\Workout;
use App\Modules\Content\Models\Vimeo;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Content\Models\Sanity\BannerCard;
use Modules\Content\Models\Sanity\OnboardingContentCard;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\PermissionService;
use App\Decorators\Content\UrlDecorator;

class SanityStudioCMSController extends BaseController
{
    public function renderStudio(Request $request): Response
    {
        // common settings
        $projectId = config('content.project_id');
        $dataset = config('content.dataset');
        $csrfToken = csrf_token();
        $appUrl = env('APP_URL');
        $token = env('SANITY_API_TOKEN_RW');
        // publishing workspace
        $types = [
            (new ChallengeDropDownItem())->toArray(),
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
            (new PlayAlongPart())->toArray(),
            (new Rudiment())->toArray(),
            (new OddTimes())->toArray(),
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
            (new SemesterPackLesson())->toArray(),
            (new Pack())->toArray(),
            (new PackBundle())->toArray(),
            (new PackBundleLesson())->toArray(),
            (new Method())->toArray(),
            (new MethodLevel())->toArray(),
            (new MethodCourse())->toArray(),
            (new MethodLesson())->toArray(),
            (new SongTutorial())->toArray(),
            (new SongTutorialChildren())->toArray(),
            (new Foundation())->toArray(),
            (new Unit())->toArray(),
            (new UnitPart())->toArray(),
            (new Archive())->toArray(),
            (new Artist())->toArray(),
            (new Genre())->toArray(),
            (new Permission())->toArray(),
            (new Topic())->toArray(),
            (new Essential())->toArray(),
            (new Creativity())->toArray(),
            (new Theory())->toArray(),
            (new Lifestyle())->toArray(),
            (new Focus())->toArray(),
            (new Instructor())->toArray(),
            (new License())->toArray(),
            (new Publisher())->toArray(),
            (new OnboardingContentCard())->toArray(),
            (new BannerCard())->toArray(),
        ];

        $publishing = [
            'projectId' => $projectId,
            'dataset' => $dataset,
            'token' => $token,
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
            'token' => $token,
            'name' => Workspace::Marketing->workspaceName(),
            'basePath' => Workspace::Marketing->basePath(),
            'title' => Workspace::Marketing->title(),
            'icon' => Workspace::Marketing->icon(),
            'schema' => json_encode([
                'types' => $types
            ])
        ];

        $workspaces = [
            $publishing,
            $marketing
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
            $response = $client->request(
                'GET',
                'https://www.soundslice.com/' . 'api/v1/slices/' . $slug . '/recordings',
                [
                    'auth' => $auth,
                ]
            );

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
        $urlDecorator = app()->make(UrlDecorator::class);



        if ($request->get('_type') === 'permission') {
            $query = \App\Modules\Content\Models\Permission::query();

            //set permission based on railcontent_id || (name && brand)
            $permission = $query
                ->where('id', '=', $request->get('permission_id'))
                ->orWhere(function ($builder) use ($request) {
                    $builder->where('name', '=', $request->get('name'))
                        ->where('brand', '=', $request->get('brand'));
                })
                ->first();

            //create new permission if specified queried permission in Sanity db doesn't exist
            if (!$permission) {
                $permission = new \App\Modules\Content\Models\Permission();
            }
            //set attributes of existing permission
            $permission->name = $request->get('name');
            $permission->brand = $request->get('brand');
            $permission->sanity_ref = str_replace('drafts.', '', $request->get('_id'));
            $permission->save();    //save permission as a row in Sanity db
            return ['railcontent_id' => $permission->id];    //return railcontent_id as permission id attribute

        } else {
            $updatedContents = [];
            $lessonType = $this->getLessonType($request->get('_type'));
            $content = $this->findOrCreateContent($request, $lessonType);
            $assignments = $content->setAssignments($request->get('assignment'));
            if ($request->has('permission')) {
                $sanityPermissionsRef = collect($request->get('permission'))->pluck('_ref')->toArray();
                $rcPermissions = \App\Modules\Content\Models\Permission::query()->whereIn('sanity_ref', $sanityPermissionsRef)->get();
                $content->setPermissions(collect($rcPermissions)->pluck('id')->toArray());
            }

            if ($request->has('childrenArray')) {
                $chilrens = $request->get('childrenArray');
                foreach ($chilrens as $index => $children) {
                    $childId = $children['railcontent_id'];
                    $sanityId = $children['_id'];
                    if (!$childId) {
                        $child = new Content();
                        $child->type = $children['_type'];
                        $child->slug = $children['slug'];
                        $child->brand = $children['brand'];
                        $child->language   = 'en-US';
                        $child->created_on = Carbon::now()->toDateTimeString();
                        $child->status     = $children['status'];
                        $child->save();
                        $childId = $child->id;
                    } else {
                        $childType = $this->getLessonType($children['_type']);
                        $child = Content::query()
                            ->where('id', '=', $childId)
                            ->where('type', '=', $childType)
                            ->first();
                    }

                    $childChildrens = collect($children['children'] ?? []);
                    $child->setParentId($content->id, 1);
                    $child->setParentContentData([$content]);
                    $content->setChildId($childId, ($index + 1));
                    if ($content->parent_content_data) {
                        $childParentContentData = json_decode($child->parent_content_data);
                        $parentContentData =  json_decode($content->parent_content_data);

                        foreach ($parentContentData ?? [] as $parentContentDatum) {
                            array_push($childParentContentData, $parentContentDatum);
                        }
                        $child->parent_content_data = json_encode($childParentContentData);

                    }

                    $this->decorateContent($child, $urlDecorator);
                    $updatedContents = $this->updateHierarchy($childChildrens, [$child,$content], $urlDecorator, $updatedContents);

                    $child->save();
                    $updatedContents[] = ['railcontent_id' => $child->id, 'web_url_path' => $child->web_url_path, 'parent_content_data' => $child->parent_content_data, '_id' => $sanityId];
                }
            }
            $hasNullId = false;
            if ($request->has('parent_id')) {
                $parentContentData = $request->get('parent_content_data');
                $hasNullId = is_array($parentContentData) && collect($parentContentData)->contains(function ($item) {
                    return $item['id'] === null;
                });

                $content->parent_content_data = json_encode($parentContentData);
                if ($request->get('parent_id')) {
                    $content->setParentId($request->get('parent_id'), 1);
                }

            }

            if (!$hasNullId) {
                $this->decorateContent($content, $urlDecorator);
            }
            $content->save();
            $results = ['railcontent_id' => $content->id, 'web_url_path' => $content->web_url_path, 'parent_content_data' => $content->parent_content_data];
            if ($assignments) {
                $results['assignments'] = $assignments;
            }
            $results['relatedDocs'] = $updatedContents;

            return $results;
        }
    }

    /**
     * Finds or creates the top-level content based on the request.
     *
     * @param Request $request
     * @return Content
     */
    private function findOrCreateContent(Request $request, $lessonType): Content
    {
        // Attempt to find an existing content.
        $content = Content::query()
            ->where('type', '=', $lessonType)
            ->where('id', '=', $request->get('railcontent_id'))
            ->first();

        // Create a new content if it doesn't exist.
        if (!$content) {
            $content = new Content();
            $content->type = $lessonType;
            $content->language = 'en-US';
            $content->slug = $request->get('slug')['current'] ?? null;
            $content->created_on = Carbon::now()->toDateTimeString();
            $content->status = $request->get('status');
            $content->brand = $request->get('brand');
            $content->save();
        }

        $content->slug = $request->get('slug')['current'] ?? null;
        $content->status = $request->get('status');
        $content->brand = $request->get('brand');
        $publishedOn = $request->get('published_on') ?? null;
        $content->published_on = $publishedOn ? Carbon::parse($publishedOn) : null;

        $content->setTitle($request->get('title'));
        $content->setDifficulty($request->get('difficulty'));
        $content->setXP($request->get('xp'));
        $content->setReleased($request->get('released'));
        $content->setAlbum($request->get('album'));

        $content->save();
        return $content;
    }

    /**
     * Decorates a content object with its web URL.
     *
     * @param Content $content
     * @param UrlDecorator $urlDecorator
     * @return void
     */
    private function decorateContent(Content $content, UrlDecorator $urlDecorator): void
    {
        $content = $urlDecorator->decorate(collect([$content]))->first();
        $webUrlPath = parse_url($content['url'] ?? '', PHP_URL_PATH);
        if ($webUrlPath) {
            $content->setWebUrlPath($webUrlPath);
        }
        unset($content['url']);
    }

    /**
     * Retrieves the lesson type based on the Sanity type.
     *
     * @param string|null $type
     * @return string|null
     */
    private function getLessonType(?string $type): ?string
    {
        return array_flip(PrimaryURLSlugToContentTypeMap::$contentTypeToSanityTypeMapping)[$type] ?? $type;
    }

    public function getVimeoEndpoints(string $vimeoId): ?Vimeo
    {
        $video = Vimeo::where('external_id', $vimeoId)->first();
        if (!$video) {
            ConfigService::$brand = 'musora';
            $vimeoTrailerDecorator = app()->make(VimeoTrailerDecorator::class);
            $vimeo = $vimeoTrailerDecorator->decorate($vimeoId);
            foreach ($vimeo['captions'] as $caption) {
                $client = new Client();
                $response = $client->get($caption['link'], ['stream' => true]);
                Storage::disk('s3')->put($caption['name'], $response->getBody(), 'public');
                $caption['link'] = Storage::disk('s3')->url($caption['name']);
            }
            if ($vimeo) {
                $video = Vimeo::create(
                    [
                        'external_id' => $vimeoId,
                        'video_poster_image_url' => $vimeo['video_poster_image_url'],
                        'video_playback_endpoints' => json_encode($vimeo['video_playback_endpoints']),
                        'hlsManifestUrl' => $vimeo['hlsManifestUrl'],
                        'length_in_seconds' => $vimeo['length_in_seconds'],
                        'captions' => json_encode($vimeo['captions'] ?? []),
                    ]
                );
            }
        }

        return $video;
    }

    /**
     * @param array $children
     * @param array $parents
     * @param mixed $urlDecorator
     * @param array $updatedContents
     * @return array
     */
    private function updateHierarchy(
        Collection $children,
        array $parents,
        mixed $urlDecorator,
        array $updatedContents
    ): array {
        foreach ($children as $index => $childOfChildId) {
            $childOfChild = Content::find($childOfChildId['railcontent_id']);
            $childOfChild->setParentId(\Arr::last($parents)['id'], $index + 1);
            $childOfChild->setParentContentData($parents);
            $this->decorateContent($childOfChild, $urlDecorator);
            $childOfChild->save();

            $updatedContents[] = [
                '_id' => $childOfChildId['_id'],
                'railcontent_id' => $childOfChild->id,
                'web_url_path' => $childOfChild->web_url_path,
                'parent_content_data' => $childOfChild->parent_content_data
            ];
        }
        return $updatedContents;
    }

    public function getYoutubeDuration(Request $request): int
    {
        $brand = $request->get('brand');
        $videoId = $request->get('id');

        $client = new \Google_Client();
        $youtube = new \Google_Service_YouTube($client);

        $client->setClientId(config("railcontent.video_sync.$brand.youtube_client_api.client_id"));
        $client->setClientSecret(config("railcontent.video_sync.$brand.youtube_client_api.client_secret"));

        $client->setScopes(['https://www.googleapis.com/auth/youtube']);
        $client->setAccessType("offline");
        $client->setApprovalPrompt('force');

        $tokenData = $client->refreshToken(
            config("railcontent.video_sync.$brand.youtube_client_api.refresh_token")
        );
        $client->setAccessToken($tokenData['access_token']);
        $videoParams = array(
            'id' => $videoId,
            'fields' => "items(contentDetails(duration))",
        );
        $videoDetails = $youtube->videos->listVideos("contentDetails", $videoParams);
        $duration = $videoDetails->getItems()[0]->getContentDetails()->getDuration();

        return $this->covtime($duration);
    }

    /**
     * @throws \Exception
     */
    private function covtime(string $youtube_time): int
    {
        $interval = new \DateInterval($youtube_time);

        return ($interval->d * 24 * 60 * 60) +
            ($interval->h * 60 * 60) +
            ($interval->i * 60) +
            $interval->s;
    }
}
