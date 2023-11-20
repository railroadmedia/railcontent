<?php

namespace App\Modules\MusoraCenter\Services;

use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;

class UrlHelperService
{
    /**
     * @var ContentService
     */
    private $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function getUrlFromId(
        $id,
        $queryString = '',
        $availableContentStatues = false,
        $pullFutureContent = true,
        $bypassPermissions = true,
        $forceSubdomain = null
    ) {
        ContentRepository::$availableContentStatues = $availableContentStatues;
        ContentRepository::$pullFutureContent = $pullFutureContent;
        ContentRepository::$bypassPermissions = $bypassPermissions;

        $content = $this->contentService->getById($id);
        $url = '';

        if (env('APP_ENV') == 'production') {
            $subDomain = 'www';
        } elseif (env('APP_ENV') == 'staging') {
            $subDomain = 'staging';
        } else {
            $subDomain = 'dev';
        }

        $subDomain = $forceSubdomain ?? $subDomain;

        if ($content['brand'] == 'drumeo') {
            if (in_array(
                $content['type'],
                [
                    'live',
                    'gear-guides',
                    'challenges',
                    'boot-camps',
                    'quick-tips',
                    'podcasts',
                    'on-the-road',
                    'behind-the-scenes',
                    'study-the-greats',
                    'solos',
                    'sonor-drums',
                    '25-days-of-christmas',
                    'paiste-cymbals',
                    'rhythms-from-another-planet',
                    'namm-2019',
                    'the-history-of-electronic-drums',
                    'backstage-secrets',
                    'spotlight',
                ]
            )) {

                $url =
                    'https://' .
                    $subDomain .
                    '.drumeo.com/members/lessons/' .
                    $content['type'] .
                    '/' .
                    $content['id'] .
                    $queryString;

            } elseif ($content['type'] == 'course') {

                $url = 'https://' . $subDomain . '.drumeo.com/members/lessons/courses/' . $content['id'] . $queryString;

            } elseif ($content['type'] == 'course-part') {

                $url =
                    'https://' .
                    $subDomain .
                    '.drumeo.com/members/lessons/course-part/' .
                    $content['id'] .
                    $queryString;

            } elseif ($content['type'] == 'edge-pack') {

                $url =
                    'https://' .
                    $subDomain .
                    '.drumeo.com/members/packs/edge-bundle/' .
                    $content['slug'] .
                    $queryString;

            } elseif ($content['type'] == 'learning-path') {

                $url =
                    'https://' .
                    $subDomain .
                    '.drumeo.com/laravel/public/members/learning-paths/' .
                    $content['slug'] .
                    $queryString;

            } elseif ($content['type'] == 'pack') {

                $url = 'https://' . $subDomain . '.drumeo.com/members/packs/' . $content['slug'] . $queryString;

            } elseif ($content['type'] == 'pack-bundle') {

                $packs = $this->contentService->getByChildIdWhereParentTypeIn(
                    $content['id'],
                    ['pack']
                );
                $pack = reset($packs);

                if (!empty($pack)) {

                    $url =
                        'https://' .
                        $subDomain .
                        '.drumeo.com/members/packs/' .
                        $pack[0]['slug'] .
                        '/' .
                        $content['slug'] .
                        $queryString;
                }

            } elseif ($content['type'] == 'pack-bundle-lesson') {

                $packBundles = $this->contentService->getByChildIdWhereParentTypeIn($content['id'], ['pack-bundle']);
                $packBundle = $packBundles->first();

                if (!empty($packBundle)) {

                    $packs = $this->contentService->getByChildIdWhereParentTypeIn(
                        $packBundle['id'],
                        ['pack']
                    );
                    $pack = $packs->first();

                    $allPackBundles = $this->contentService->getByParentId($pack['id']);

                    if (!empty($pack) && count($allPackBundles) > 1) {
                        $url =
                            'https://' .
                            $subDomain .
                            '.drumeo.com/members/packs/' .
                            $pack['slug'] .
                            '/' .
                            $packBundle['slug'] .
                            '/' .
                            $content['slug'] .
                            $queryString;
                    } else {
                        $url =
                            'https://' .
                            $subDomain .
                            '.drumeo.com/members/packs/' .
                            $pack['slug'] .
                            '/' .
                            $content['slug'] .
                            $queryString;
                    }
                }

            } elseif ($content['type'] == 'play-along') {

                $url =
                    'https://' .
                    $subDomain .
                    '.drumeo.com/members/lessons/play-alongs/' .
                    $content['id'] .
                    $queryString;

            } elseif ($content['type'] == 'song') {

                $url = 'https://' . $subDomain . '.drumeo.com/members/lessons/songs/' . $content['id'] . $queryString;

            } elseif ($content['type'] == 'student-focus') {

                $url =
                    'https://' .
                    $subDomain .
                    '.drumeo.com/members/lessons/student-focus/' .
                    $content['id'] .
                    $queryString;

            } elseif ($content['type'] == 'exploring-beats') {

                $url =
                    'https://' .
                    $subDomain .
                    '.drumeo.com/members/lessons/exploring-beats/' .
                    $content['id'] .
                    $queryString;

            } elseif ($content['type'] == 'performances') {

                $url =
                    'https://' .
                    $subDomain .
                    '.drumeo.com/members/lessons/performances/' .
                    $content['id'] .
                    $queryString;

            } elseif ($content['type'] == 'study-the-greats') {

                $url =
                    'https://' .
                    $subDomain .
                    '.drumeo.com/members/lessons/study-the-greats/' .
                    $content['id'] .
                    $queryString;

            } elseif ($content['type'] === 'semester-pack-lesson') {
                $parent =
                    $this->contentService->getByChildIdWhereType($content['id'], 'semester-pack')
                        ->first();
                $url =
                    'https://' .
                    $subDomain .
                    '.drumeo.com/members/semester-packs/' .
                    $parent['slug'] .
                    '/' .
                    $content['slug'] .
                    $queryString;
            }
        } elseif ($content['brand'] == 'pianote') {

            $url = 'https://' . $subDomain . '.pianote.com/members/content/' .  $content['id'];

        } elseif ($content['brand'] == 'guitareo') {

            if ($content['type'] == 'chord-and-scale') {

                $url =
                    'https://' . $subDomain . '.guitareo.com/members/chords-scales/' . $content['slug'] . $queryString;

            } elseif ($content['type'] == 'course') {

                $url =
                    'https://' . $subDomain . '.guitareo.com/members/guitar-lessons/' . $content['slug'] . $queryString;

            } elseif ($content['type'] == 'course-part') {

                $courses = $this->contentService->getByChildIdWhereParentTypeIn($content['id'], ['course']);
                $course = reset($courses);

                if (!empty($course)) {
                    $url =
                        'https://' .
                        $subDomain .
                        '.guitareo.com/members/guitar-lessons/' .
                        $course['slug'] .
                        '/' .
                        $content['slug'] .
                        $queryString;
                }

            } elseif ($content['type'] == 'song') {

                $url =
                    'https://' . $subDomain . '.guitareo.com/members/guitar-songs/' . $content['slug'] . $queryString;

            } elseif ($content['type'] == 'song-part') {

                $songs = $this->contentService->getByChildIdWhereParentTypeIn($content['id'], ['song']);
                $song = reset($songs);

                if (!empty($song)) {
                    $url =
                        'https://' .
                        $subDomain .
                        '.guitareo.com/members/guitar-songs/' .
                        $song['slug'] .
                        '/' .
                        $content['slug'] .
                        $queryString;
                }

            } elseif ($content['type'] == 'play-along') {

                $url =
                    'https://' . $subDomain . '.guitareo.com/members/guitar-songs/' . $content['slug'] . $queryString;

            } elseif ($content['type'] == 'play-along-part') {

                $playAlongs = $this->contentService->getByChildIdWhereParentTypeIn($content['id'], ['play-along']);
                $playAlong = reset($playAlongs);

                if (!empty($playAlong)) {
                    $url =
                        'https://' .
                        $subDomain .
                        '.guitareo.com/members/guitar-songs/' .
                        $playAlong['slug'] .
                        '/' .
                        $content['slug'] .
                        $queryString;
                }

            } elseif ($content['type'] == 'learning-path') {

                $url =
                    'https://' . $subDomain . '.guitareo.com/members/lesson-plans/' . $content['slug'] . $queryString;

            } elseif ($content['type'] == 'recording') {

                $url = 'https://' . $subDomain . '.guitareo.com/members/live/' . $content['slug'] . $queryString;

            } elseif ($content['type'] == 'pack') {

                $url = 'https://' . $subDomain . '.guitareo.com/members/' . $content['slug'] . $queryString;

            } elseif ($content['type'] == 'pack-bundle') {

                $packs = $this->contentService->getByChildIdWhereParentTypeIn(
                    $content['id'],
                    ['pack']
                );
                $pack = reset($packs);

                if (!empty($pack)) {
                    $url = 'https://' . $subDomain . '.guitareo.com/members/' . $pack['slug'] . $queryString;
                }

            } elseif ($content['type'] == 'pack-bundle-lesson') {

                $packBundles = $this->contentService->getByChildIdWhereParentTypeIn($content['id'], ['pack-bundle']);
                $packBundle = reset($packBundles);

                if (!empty($packBundle)) {

                    $packs = $this->contentService->getByChildIdWhereParentTypeIn(
                        $packBundle['id'],
                        ['pack']
                    );
                    $pack = reset($packs);

                    if (!empty($pack)) {
                        $url =
                            'https://' .
                            $subDomain .
                            '.guitareo.com/members/' .
                            $pack['slug'] .
                            '/' .
                            $content['slug'] .
                            $queryString;
                    }
                }

            } elseif ($content['type'] === 'semester-pack-lesson') {
                $parent =
                    $this->contentService->getByChildIdWhereType($content['id'], 'semester-pack')
                        ->first();
                $url =
                    'https://' .
                    $subDomain .
                    '.guitareo.com/members/semester-pack/' .
                    $parent['slug'] .
                    '/' .
                    $parent['id'] .
                    '/' .
                    $content['slug'] .
                    '/' .
                    $content['id'] .
                    $queryString;
            }

        } elseif ($content['brand'] == 'recordeo') {

            // course
            if (isset($content['parent_slug_hierarchy']['learning-path']) &&
                !isset($content['parent_slug_hierarchy']['course'])) {
                $learningPathSlug = reset($content['parent_slug_hierarchy']['learning-path']);

                $url =
                    'https://' .
                    $subDomain .
                    '.recordeo.com/members/' .
                    $learningPathSlug .
                    '/' .
                    $content['slug'] .
                    $queryString;
            }

            // course part
            if (isset($content['parent_slug_hierarchy']['learning-path']) &&
                isset($content['parent_slug_hierarchy']['course'])) {
                $learningPathSlug = reset($content['parent_slug_hierarchy']['learning-path']);
                $courseSlug = reset($content['parent_slug_hierarchy']['course']);

                $url =
                    'https://' .
                    $subDomain .
                    '.recordeo.com/members/' .
                    $learningPathSlug .
                    '/' .
                    $courseSlug .
                    '/' .
                    $content['slug'] .
                    '/' .
                    $content['id'] .
                    $queryString;
            }

            // welcome course
            if ($content['slug'] == 'welcome-to-recordeo-start-here') {

                $url = 'https://' . $subDomain . '.recordeo.com/members/' . 'orientation-course' . $queryString;
            }

            // welcome course part
            if (array_search('welcome-to-recordeo-start-here', $content['parent_slug_hierarchy']['course'] ?? []) !==
                false) {

                $url =
                    'https://' .
                    $subDomain .
                    '.recordeo.com/members/' .
                    'orientation-course' .
                    '/' .
                    $content['slug'] .
                    '/' .
                    $content['id'] .
                    $queryString;
            }

            // learning path
            if ($content['type'] == 'learning-path') {
                $url = 'https://' . $subDomain . '.recordeo.com/members' . $queryString;
            }
        }

        return $url;
    }
}
