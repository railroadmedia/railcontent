<?php

namespace App\Decorators\Forums;

use Carbon\Carbon;
use Exception;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Request;

class PostUrlsDecorator
{
    public const HTML_HREF_REGEX_PATTERN = '#<a[^>]+href=\"(.*?)\"[^>]*>#';

    private $contentService;

    /**
     * @param $contentService
     */
    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function decorate($posts)
    {
        $unifiedLaunchDate = Carbon::parse(config('ecommerce.launch_dates.unified'));
        foreach ($posts as $index => $post) {
            $postDate = Carbon::parse($posts[$index]['updated_at']);
            if ($unifiedLaunchDate->lessThan($postDate)) {
                continue;
            }
            $posts[$index]['url'] = route('forums.jump-to-post', ['brand' => config('railnotifications.brand'), 'postId' => $post['id']]);
            $posts[$index]['created_at_diff'] = Carbon::parse($posts[$index]['created_at'])
                ->diffForHumans();

            $url = str_replace(
                [
                    '"/members/forums',
                    '"/members/',
                    '"/pianote/forums',
                    'forums.drumeo.com/index.php?',
                ],
                [
                    '"'.route('forums.show-categories'),
                    '"'.config('app.url').'/'.brand().'/',
                    '"'.route('forums.show-categories'),
                    route('forums.show-categories'),
                ],
                $posts[$index]['content']
            );
            $posts[$index]['content'] = $url;

            if (preg_match_all(self::HTML_HREF_REGEX_PATTERN, $post['content'], $matches)) {
                $urls = $this->getUrls($matches[1]);
                foreach ($urls as $oldUrl => $mwpUrl) {
                    $posts[$index]['content'] = str_replace($oldUrl, $mwpUrl, $posts[$index]['content']);
                }
            }
        }

        return $posts;
    }

    public function formatNewUrl(
        $segments,
        $url
    ) {
        if (empty($segments)) {
            switch ($url) {
                case 'www.drumeo.com':
                    $url = config('app.url').'/drumeo';
                    break;
                case 'www.pianote.com':
                    $url = config('app.url').'/pianote';
                    break;
                case 'www.guitareo.com':
                    $url = config('app.url').'/guitareo';
                    break;
                case 'www.singeo.com':
                    $url = config('app.url').'/singeo';
                    break;
                default:
                    $url = config('app.url').'/'.brand();
            }

            return $url;
        }

        if (isset($segments[0]) &&
            ($segments[0] == 'drumshop' ||
                $segments[0] == 'lifetime' ||
                $segments[0] == 'beat' ||
                $segments[0] == 'recitals' ||
                $segments[0] == 'guitar-technique-made-easy-discount')) {
            return $url;
        }

        if (!isset($segments[1]) || $segments[1] == null) {
            return config('app.url').'/'.$segments[0];
        }

        if (isset($segments[1]) && $segments[1] == 'playlist') {
            return $url;
        }

        $lastSegment = last($segments);
        $numberOfSegments = count($segments);

        if (in_array($lastSegment, [
            'archives',
            'backstage-secrets',
            'behind-the-scenes',
            'boot-amps',
            'boot-camps',
            'boot-camps',
            'bootcamps',
            'challenges',
            'chords-and-scales',
            'chords-scales',
            'coaches',
            'courses',
            'diy-drum-experiments',
            'exploring-beats',
            'gear-guides',
            'in-rhythm',
            'lessons',
            'library',
            'live',
            'live-streams',
            'on-the-road',
            'packs',
            'paiste-cymbals',
            'performances',
            'play-alongs',
            'podcasts',
            'question-and-answer',
            'quick-tips',
            'recording',
            'rhythmic-adventures-of-captain-carson',
            'rhythms-from-another-planet',
            'routines',
            'rudiments',
            'schedule',
            'shows',
            'solos',
            'songs',
            'sonor-drums',
            'spotlight',
            'student-collaborations',
            'student-focus',
            'student-reviews',
            'study-the-greats',
            'support',
            'tama-drums',
            'the-history-of-electronic-drums',
        ])) {
            $url = str_replace(
                [
                    'www.drumeo.com/members/lessons',
                    'www.pianote.com/members',
                    'www.singeo.com/members',
                    'www.guitareo.com',
                    'www.drumeo.com/laravel/public/members',
                ],
                [
                    'www.musora.com/drumeo',
                    'www.musora.com/pianote',
                    'www.musora.com/singeo',
                    'www.musora.com/guitareo',
                    'www.musora.com/drumeo',
                ],
                $url
            );

            return $url;
        }

        ContentRepository::$bypassPermissions = true;
        $availableBrands = ConfigService::$availableBrands;
        ConfigService::$availableBrands = ['drumeo', 'pianote', 'guitareo', 'singeo'];

        if (in_array('forums', $segments)) {
            if ($numberOfSegments > 0) {
                if ($lastSegment == "forums") {
                    $url = config('app.url').'/'.$segments[0].'/forums';
                } elseif (in_array('jump-to-post', $segments)) {
                    $url = route('forums.jump-to-post', ['postId' => $lastSegment]);
                } else {
                    $url = route('forums.jump-to-thread', ['threadId' => $lastSegment]);
                }

                ConfigService::$availableBrands = $availableBrands;

                return $url;
            }
            ConfigService::$availableBrands = $availableBrands;
            return $url;
        } elseif (is_numeric($lastSegment)) {
            $content = $this->contentService->getById($lastSegment);
            ConfigService::$availableBrands = $availableBrands;
            return $content['url'] ?? '';
        } elseif ($numberOfSegments == 3 && $segments[1] == 'semester-packs') {
            return $this->GetContentBySlugAndTypeSetBrands($lastSegment, $availableBrands, 'semester-pack');
        } elseif ($numberOfSegments == 3 && $segments[1] == 'coaches') {
            return $this->GetContentBySlugAndTypeSetBrands($lastSegment, $availableBrands, 'instructor');
        } elseif ($numberOfSegments == 3 && $segments[1] == 'learning-paths') {
            return $this->GetContentBySlugAndTypeSetBrands($lastSegment, $availableBrands, 'learning-path');
        } elseif ($numberOfSegments == 4 && $segments[1] == 'packs') {
            return $this->GetContentBySlugAndTypeSetBrands($lastSegment, $availableBrands, 'pack-bundle');
        } elseif ($numberOfSegments == 5 && $segments[1] == 'packs') {
            return $this->GetContentBySlugAndTypeSetBrands($lastSegment, $availableBrands, 'pack-bundle-lesson');
        } elseif ($numberOfSegments == 4 && $segments[1] == 'semester-packs') {
            return $this->GetContentBySlugAndTypeSetBrands($lastSegment, $availableBrands, 'semester-pack-lesson');
        } elseif ($numberOfSegments == 4 && $segments[1] == 'learning-paths') {
            return $this->GetContentBySlugAndTypeSetBrands($lastSegment, $availableBrands, 'learning-path-level');
        } elseif (in_array('packs', $segments) && !is_numeric($lastSegment)) {
            return $this->GetContentBySlugAndTypeSetBrands($lastSegment, $availableBrands, 'pack');
        } elseif ($lastSegment == 'loops') {
            $url = str_replace(
                [
                    'www.drumeo.com/members/lessons',
                    'www.drumeo.com/laravel/public/members',
                    'www.pianote.com/members',
                    'www.singeo.com',
                    'www.guitareo.com',
                    'loops',
                ],
                [
                    'www.musora.com/drumeo',
                    'www.musora.com/drumeo',
                    'www.musora.com/pianote',
                    'www.musora.com/singeo',
                    'www.musora.com/guitareo',
                    'legacy-resources/loops',
                ],
                $url
            );
            ConfigService::$availableBrands = $availableBrands;

            return $url;
        }
        ConfigService::$availableBrands = $availableBrands;

        return $url;
    }

    private function GetContentBySlugAndTypeSetBrands($lastSegment, $availableBrands, $type)
    {
        $content =
            $this->contentService->getBySlugAndType($lastSegment, $type)
                ->first();
        ConfigService::$availableBrands = $availableBrands;
        return $content['url'];
    }

    /**
     * @param $matches
     * @return array
     */
    private function getUrls($matches): array
    {
        $urls = [];

        foreach ($matches as $match) {
            $url = $match;
            //check if the url is valid
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                continue;
            }
            try {
                $initialRequest = Request::create($url);

                if (!in_array($initialRequest->getHttpHost(), [
                    'www.drumeo.com',
                    'www.pianote.com',
                    'www.singeo.com',
                    'www.guitareo.com',
                    'forums.drumeo.com',
                    request()->getHttpHost(),
                ])) {
                    continue;
                }

                $oldRequest = Request::create($url);
                $segments = $this->formatNewUrl($oldRequest->segments(), $url);
                if ($oldRequest->getQueryString()) {
                    $segments = $segments.'?'.$oldRequest->getQueryString();
                }
                $urls[$match] = $segments;
            } catch (Exception $e) {
                continue;
            }

        }

        return $urls;
    }
}
