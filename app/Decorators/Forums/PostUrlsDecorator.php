<?php

namespace App\Decorators\Forums;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;

class PostUrlsDecorator
{
    const HTML_HREF_REGEX_PATTERN = '#<a[^>]+href=\"(.*?)\"[^>]*>#';

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
        foreach ($posts as $index => $post) {
            $posts[$index]['url'] = route('forums.jump-to-post',['brand' => config('railnotifications.brand'), 'postId' => $post['id']]);
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
        $lastSegment = last($segments);
        $numberOfSegments = count($segments);

        if (in_array($lastSegment, [
            'lessons',
            'routines',
            'courses',
            'songs',
            'coaches',
            'packs',
            'quick-tips',
            'podcasts',
            'student-focus',
            'question-and-answer',
            'student-reviews',
            'boot-camps',
            'chords-and-scales',
            'bootcamps',
            'chords-scales',
            'library',
            'recording',
            'play-alongs',
            'archives',
            'spotlight',
            'the-history-of-electronic-drums',
            'backstage-secrets',
            'student-collaborations',
            'live-streams',
            'solos',
            'boot-amps',
            'gear-guides',
            'performances',
            'in-rhythm',
            'challenges',
            'on-the-road',
            'diy-drum-experiments',
            'rhythmic-adventures-of-captain-carson',
            'study-the-greats',
            'rhythms-from-another-planet',
            'tama-drums',
            'paiste-cymbals',
            'behind-the-scenes',
            'exploring-beats',
            'sonor-drums',
            'rudiments',
            'boot-camps',
            'support',
            'live',
            'schedule',
            'shows',
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
            $content =
                $this->contentService->getBySlugAndType($lastSegment, 'semester-pack')
                    ->first();
            ConfigService::$availableBrands = $availableBrands;

            return $content['url'];
        } elseif ($numberOfSegments == 3 && $segments[1] == 'coaches') {
            $content =
                $this->contentService->getBySlugAndType($lastSegment, 'instructor')
                    ->first();
            ConfigService::$availableBrands = $availableBrands;

            return $content['url'];
        } elseif ($numberOfSegments == 3 && $segments[1] == 'learning-paths') {
            $content =
                $this->contentService->getBySlugAndType($lastSegment, 'learning-path')
                    ->first();
            ConfigService::$availableBrands = $availableBrands;

            return $content['url'];
        } elseif ($numberOfSegments == 4 && $segments[1] == 'packs') {
            $content =
                $this->contentService->getBySlugAndType($lastSegment, 'pack-bundle')
                    ->first();
            ConfigService::$availableBrands = $availableBrands;

            return $content['url'];
        } elseif ($numberOfSegments == 5 && $segments[1] == 'packs') {
            $content =
                $this->contentService->getBySlugAndType($lastSegment, 'pack-bundle-lesson')
                    ->first();
            ConfigService::$availableBrands = $availableBrands;

            return $content['url'];
        } elseif ($numberOfSegments == 4 && $segments[1] == 'semester-packs') {
            $content =
                $this->contentService->getBySlugAndType($lastSegment, 'semester-pack-lesson')
                    ->first();
            ConfigService::$availableBrands = $availableBrands;

            return $content['url'];
        } elseif ($numberOfSegments == 4 && $segments[1] == 'learning-paths') {
            $content =
                $this->contentService->getBySlugAndType($lastSegment, 'learning-path-level')
                    ->first();
            ConfigService::$availableBrands = $availableBrands;

            return $content['url'];
        } elseif (in_array('packs', $segments) && !is_numeric($lastSegment)) {
            $content =
                $this->contentService->getBySlugAndType($lastSegment, 'pack')
                    ->first();
            ConfigService::$availableBrands = $availableBrands;

            return $content['url'];
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

    /**
     * @param $matches
     * @return array
     */
    private function getUrls($matches)
    : array {
        $urls = [];

        foreach ($matches as $match) {
            $url = $match;

            $initialRequest = \Request::create($url);

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

            $oldRequest = \Request::create($url);
            $segments = $this->formatNewUrl($oldRequest->segments(), $url);
            if ($oldRequest->getQueryString()) {
                $segments = $segments.'?'.$oldRequest->getQueryString();
            }
            $urls[$match] = $segments;
        }

        return $urls;
    }
}
