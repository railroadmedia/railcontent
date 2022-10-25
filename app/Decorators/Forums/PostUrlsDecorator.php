<?php

namespace App\Decorators\Forums;

use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;

class PostUrlsDecorator
{
    const HTML_HREF_REGEX_PATTERN = '#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#';
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
        foreach($posts as $index=>$post)
        {
            $url = str_replace(
                [
                    '"/members/forums'
                ],
                [
                    '"'.route('forums.show-categories'),
                ],
                $posts[$index]['content']
            );
            $posts[$index]['content'] = $url;

            if (preg_match_all(self::HTML_HREF_REGEX_PATTERN, $post['content'], $matches)) {
                $urls = $this->getUrls($matches[0]);
                foreach ($urls as $oldUrl => $mwpUrl) {
                    $posts[$index]['content'] =
                        str_replace($oldUrl, $mwpUrl, $posts[$index]['content']);
                }
            }
        }

        return $posts;
    }

    public function formatNewUrl(
        $segments,
        $url
    ) {

        ContentRepository::$bypassPermissions = true;
        $unifiedUrl = '/'.$segments[0].'/';
        if (isset($segments[0]) &&
            ($segments[0] == 'drumshop' ||
                $segments[0] == 'lifetime' ||
                $segments[0] == 'beat' ||
                $segments[0] == 'recitals' ||
                $segments[0] == 'guitar-technique-made-easy-discount')) {
            return $url;
        }

        if (!isset($segments[1]) || $segments[1] == null) {
            return $unifiedUrl;
        }
        $lastSegment = last($segments);
        $numberOfSegments = count($segments);

        if (in_array($lastSegment, [
            'lessons',
            'routines',
            'courses',
            'songs',
            'quick-tips',
            'podcasts',
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

        if (($segments[1] == 'forums') ||($segments[2] == 'forums')) {

            $url = str_replace(
                [
                    'www.drumeo.com/members/lessons',
                    'www.drumeo.com/laravel/public/members',
                    'www.drumeo.com/members',
                    'www.pianote.com/members',
                    'www.singeo.com/members',
                    'www.singeo.com',
                    'www.guitareo.com',
                    'loops',
                ],
                [
                    'www.musora.com/drumeo',
                    'www.musora.com/drumeo',
                    'www.musora.com/drumeo',
                    'www.musora.com/pianote',
                    'www.musora.com/singeo',
                    'www.musora.com/singeo',
                    'www.musora.com/guitareo',
                    'legacy-resources/loops',
                ],
                $url
            );

            return $url;
        }elseif (is_numeric($lastSegment)) {
            $content = $this->contentService->getById($lastSegment);
            return $content['url'] ?? '';
        } elseif ($numberOfSegments == 3 && $segments[1] == 'packs') {
            $content =
                $this->contentService->getBySlugAndType($lastSegment, 'pack')
                    ->first();

            return $content['url'];
        } elseif ($numberOfSegments == 3 && $segments[1] == 'semester-packs') {
            $content =
                $this->contentService->getBySlugAndType($lastSegment, 'semester-pack')
                    ->first();

            return $content['url'];
        } elseif ($numberOfSegments == 3 && $segments[1] == 'coaches') {
            $content =
                $this->contentService->getBySlugAndType($lastSegment, 'instructor')
                    ->first();

            return $content['url'];
        } elseif ($numberOfSegments == 3 && $segments[1] == 'learning-paths') {
            $content =
                $this->contentService->getBySlugAndType($lastSegment, 'learning-path')
                    ->first();

            return $content['url'];
        } elseif ($numberOfSegments == 4 && $segments[1] == 'packs') {
            $content =
                $this->contentService->getBySlugAndType($lastSegment, 'pack-bundle')
                    ->first();

            return $content['url'];
        } elseif ($numberOfSegments == 5 && $segments[1] == 'packs') {
            $content =
                $this->contentService->getBySlugAndType($lastSegment, 'pack-bundle-lesson')
                    ->first();

            return $content['url'];
        } elseif ($numberOfSegments == 4 && $segments[1] == 'semester-packs') {
            $content =
                $this->contentService->getBySlugAndType($lastSegment, 'semester-pack-lesson')
                    ->first();

            return $content['url'];
        } elseif ($numberOfSegments == 4 && $segments[1] == 'learning-paths') {
            $content =
                $this->contentService->getBySlugAndType($lastSegment, 'learning-path-level')
                    ->first();

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

            return $url;
        }

        return $unifiedUrl;
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
                'forums.drumeo.com'
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
