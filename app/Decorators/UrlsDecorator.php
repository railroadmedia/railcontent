<?php

namespace App\Decorators;

use Railroad\Railcontent\Entities\CommentEntity;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Support\Collection;

class UrlsDecorator extends \Railroad\Railcontent\Decorators\ModeDecoratorBase
{
    public const HTML_HREF_REGEX_PATTERN = '#<a[^>]+href=\"(.*?)\"[^>]*>#';
    public $brand;
    public $id;
    private $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
        $this->brand = brand();
    }

    public function decorate(Collection $entities)
    {
        if (self::$decorationMode !== self::DECORATION_MODE_MAXIMUM) {
            return $entities;
        }

        $initialDecorationMode = self::$decorationMode;
        self::$decorationMode = self::DECORATION_MODE_MINIMUM;

        foreach ($entities as $entityIndex => $entity) {
            if ($entity instanceof ContentEntity) {
                $this->brand = $entity['brand'];
                $entity[$entityIndex]['data'] = $this->decorateContentEntity($entity)['data'];
            } elseif ($entity instanceof CommentEntity) {
                ContentRepository::$bypassPermissions = true;
                $content = $this->contentService->getById($entity['content_id']);
                $this->brand = $content['brand'] ?? '';
                $this->id = $entity['id'];

                $decoratedEntity = $this->decorateCommentEntity($entity);
                $entity[$entityIndex]['comment'] = $decoratedEntity['comment'];
                $entity[$entityIndex]['replies'] = $decoratedEntity['replies'] ?? [];
            }
        }

        self::$decorationMode = $initialDecorationMode;

        return $entities;
    }

    private function decorateContentEntity(ContentEntity &$entity)
    {
        foreach ($entity['data'] ?? [] as $index => $data) {
            if ($this->shouldReplaceUrls($entity, $data)) {
                $entity['data'][$index]['value'] = $this->replaceUrlsInString($data['value']);
            }
        }

        return $entity;
    }

    private function decorateCommentEntity(CommentEntity &$entity)
    {
        $entity['comment'] = $this->replaceUrlsInString($entity['comment']);

        foreach ($entity['replies'] ?? [] as $index => $reply) {
            $entity['replies'][$index]['comment'] = $this->replaceUrlsInString($reply['comment']);
        }

        return $entity;
    }

    private function shouldReplaceUrls(ContentEntity $entity, $data)
    {
        $isLessonOrAssignment = in_array(
            $entity['type'],
            array_merge(
                config('railcontent.singularContentTypes', []),
                config('railcontent.showTypes')[$entity['brand']] ?? [],
                ['assignment']
            )
        );

        return in_array($data['key'], ['description']) && $isLessonOrAssignment;
    }

    public function hasRelativeUrlsInComment($comment)
    {
        // Regular expression pattern to match URLs
        $pattern = '/href=["\']?((?:.(?!["\'?]))*.)["\'?]/';

        // Find all matches of URLs in the comment
        preg_match_all($pattern, $comment, $matches);

        // Iterate through the matched URLs
        foreach ($matches[1] as $url) {
            // Check if the URL is relative
            if (strpos($url, '/') === 0) {
                return true; // Relative URL found
            }
        }

        return false; // No relative URLs found
    }

    private function replaceUrlsInString($input)
    {
        $url = $input;
        if ($this->hasRelativeUrlsInComment($input)) {
            $url = $this->prepareRelativeUrls($input);
        }

        if (preg_match_all(self::HTML_HREF_REGEX_PATTERN, $url, $matches)) {
            $urls = $this->getUrls($matches[1]);
            foreach ($urls as $oldUrl => $mwpUrl) {
                $url = str_replace($oldUrl, $mwpUrl, $url);
            }
        }

        return $url;
    }

    private function getUrls($matches)
    {
        $urls = [];
        foreach ($matches as $match) {
            $url = $match;
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                continue;
            }

            $oldRequest = \Request::create($url);

            if (!in_array($oldRequest->getHttpHost(), [
                'www.drumeo.com',
                'www.pianote.com',
                'www.singeo.com',
                'www.guitareo.com',
                'forums.drumeo.com',
                'www.musora.com',
                'dev.musora.com',
                request()->getHttpHost(),
            ])) {
                continue;
            }
            if (!empty($oldRequest->segments())) {
                $segments = $this->formatNewUrl($oldRequest->segments(), $url);
                $urls[$match] = $segments;
            }
        }

        return $urls;
    }

    private function formatNewUrl($segments, $url)
    {
        ContentRepository::$bypassPermissions = true;
        $unifiedUrl = '/'.$segments[0].'/';
        if (isset($segments[0]) &&
            in_array(
                $segments[0],
                ['drumshop', 'lifetime', 'beat', 'recitals', 'guitar-technique-made-easy-discount']
            )) {
            return $url;
        }

        if (!isset($segments[1]) || $segments[1] == null) {
            return $unifiedUrl;
        }

        if (isset($segments[1]) && $segments[1] == 'playlist') {
            return $url;
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
            'search',
            'student-focus',
        ])) {
            $newUrl = url()->route(
                'platform.content-type-catalog',
                ['brand' => $this->brand, 'contentTypeName' => $lastSegment]
            );
            $url = str_replace($url, $newUrl, $url);

            return $url;
        }

        if (in_array('profile', $segments)) {
            $url = url()->route('platform.profile.dashboard', ['brand' => $this->brand, 'userId' => $lastSegment]);

            return $url;
        } elseif (in_array('forums', $segments)) {
            $availableBrands = ConfigService::$availableBrands;
            ConfigService::$availableBrands = ['drumeo', 'pianote', 'guitareo', 'singeo'];
            if ($numberOfSegments > 0) {
                if ($lastSegment == "forums") {
                    $url = config('app.url').'/'.$segments[0].'/forums';
                } elseif (in_array('jump-to-post', $segments)) {
                    $url = route('forums.jump-to-post', ['postId' => $lastSegment, 'brand' => $this->brand]);
                } else {
                    $url = route('forums.jump-to-thread', ['threadId' => $lastSegment, 'brand' => $this->brand]);
                }

                ConfigService::$availableBrands = $availableBrands;

                return $url;
            }
            ConfigService::$availableBrands = $availableBrands;

            return $url;
        } elseif (is_numeric($lastSegment)) {
            ContentRepository::$bypassPermissions = true;
            ContentRepository::$availableContentStatues = [
                ContentService::STATUS_PUBLISHED,
                ContentService::STATUS_DRAFT,
                ContentService::STATUS_SCHEDULED,
                ContentService::STATUS_ARCHIVED,
            ];
            $content = $this->contentService->getById($lastSegment);

            return $content['url'] ?? '';
        } elseif ($numberOfSegments == 2 && $segments[0] == 'packs') {
            $content =
                $this->contentService->getBySlugAndType($lastSegment, 'pack')
                    ->first();

            return $content['url'];
        } elseif ($numberOfSegments == 3 && $segments[1] == 'packs') {
            $content =
                $this->contentService->getBySlugAndType($lastSegment, 'pack')
                    ->first();

            return $content['url'];
        } elseif ($numberOfSegments == 2 && $segments[0] == 'semester-packs') {
            $content =
                $this->contentService->getBySlugAndType($lastSegment, 'semester-pack')
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

            return $content['url'] ?? '';
        } elseif ($numberOfSegments == 4 && $segments[1] == 'semester-packs') {
            $content =
                $this->contentService->getBySlugAndType($lastSegment, 'semester-pack-lesson')
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
     * @param $input
     * @return array|string|string[]
     */
    private function prepareRelativeUrls($input): string|array
    {
        $brand = $this->brand;

        $url = str_replace(
            [
                '"/members/forums',
                '"/members/lessons/',
                '"/members/',
                '"/pianote/forums',
                'forums.drumeo.com/index.php?',
                '"/laravel/public/members/lessons/',
                '"/laravel/public/members/archives',
                '"/chord-hacks/lessons',
                '"/members/semester-packs/drum-technique-made-easy-pack',
                '"/members/semester-packs/drum-technique-made-easy-pack/hand-to-hand-16th-notes',
                '"/members/packs',
                '"/members/live',
            ],
            [
                '"'.route('forums.show-categories'),
                '"'.config('app.url').'/'.$brand.'/',
                '"'.config('app.url').'/'.$brand.'/',
                '"'.route('forums.show-categories'),
                route('forums.show-categories'),
                '"'.config('app.url').'/'.$brand.'/',
                '"'.config('app.url').'/'.$brand.'/legacy-resources/archives',
                '"https://www.pianote.com/chord-hacks/lessons',
                '"'.config('app.url').'/'.$brand.'/semester-packs/drum-technique-made-easy-pack/248762',
                '"'.config('app.url').'/'.$brand.'/semester-packs/drum-technique-made-easy-pack/248762',
                '"'.config('app.url').'/'.$brand.'/packs',
                '"'.url()->route('platform.live', ['brand' => $brand]),
            ],
            $input
        );

        return $url;
    }
}
