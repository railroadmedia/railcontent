<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\BaseController;
use App\Modules\Brand\Services\BrandService;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Support\Collection;

class RedirectLegacyMembersURLsToUPController extends BaseController
{
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * RedirectToUPController constructor.
     *
     * @param ContentService $contentService
     */
    public function __construct(
        ContentService $contentService
    )
    {
        $this->contentService = $contentService;
    }

    public function redirectDrumeo($domain, $segment1 = null, $segment2 = null, $segment3 = null, $segment4 = null,
        $segment5 = null, $segment6 = null, $segment7 = null, $segment8 = null)
    {
        $userId = null;
        $authParams = null;

        if (user()) {
            $userId = user()->getId();
            $authParams  = '';
        }

        $unifiedUrl = get_musora_brand_base_url() . '/drumeo/';

        if ($segment1 == null) {
            return redirect()->to($unifiedUrl. $authParams);
        }

        /* here we treat all the routes that are similar */
        if (in_array($segment1, ['forums','referral', 'support', 'live', 'schedule', 'legacy-resources', 'search'])) {
            $forumUrl = $unifiedUrl . $segment1 . "/";
            foreach ([$segment2, $segment3, $segment4, $segment5] as $segment) {
                if ($segment) {
                    $forumUrl = $forumUrl . $segment . "/";
                } else {
                    break;
                }
            }
            return redirect()->to($forumUrl . $authParams);
        }

        if ($segment2 == null) {
            if (in_array($segment1, ['packs', 'coaches'])) {
                $unifiedUrl = $unifiedUrl . $segment1;
            }
            if ($segment1 == 'chat') {
                $unifiedUrl = $unifiedUrl . 'live-chat';
            } elseif ($segment1 == 'profile' && $userId) {
                $unifiedUrl = $unifiedUrl . 'profile/' . $userId. '/dashboard';
            } elseif (in_array($segment1, ['archives', 'loops', 'dictionary-of-terms'])) {
                $unifiedUrl = $unifiedUrl . 'legacy-resources/' . $segment1;
            }

            return redirect()->to($unifiedUrl . $authParams);
        }

        if ($segment3 == null) {
            //todo: make generic function for coaches, semester-packs, packs, learning-paths
            if ($segment1 == 'coaches') {
                $content = $this->contentService->getBySlugAndType($segment2, 'instructor')->first();
                if ($content) {
                    $unifiedUrl = $unifiedUrl . 'coaches/' . $segment2 . '/' . $content['id'];
                }
            } elseif ($segment1 == 'lessons') {
                if (in_array($segment2, ['all', 'subscribed'])) {
                    $unifiedUrl = $unifiedUrl . 'lessons/' . $segment2;
                } else {
                    $unifiedUrl = $unifiedUrl . $segment2;
                }
            } elseif ($segment1 == 'semester-packs') {
                $content = $this->contentService->getBySlugAndType($segment2, 'semester-pack')->first();
                if ($content) {
                    $unifiedUrl = $unifiedUrl . 'semester-packs/' . $segment2 . '/' . $content['id'];
                }
            } elseif ($segment1 == 'packs') {
                $content = $this->contentService->getBySlugAndType($segment2, 'pack')->first();
                if ($content) {
                    $unifiedUrl = $unifiedUrl . 'packs/' . $segment2 . '/' . $content['id'];
                }
            } elseif ($segment1 == 'learning-paths') {
                $content = $this->contentService->getBySlugAndType($segment2, 'learning-path')->first();
                if ($content) {
                    $unifiedUrl = $unifiedUrl . 'method/' . $segment2 . '/' . $content['id'];
                }
            } elseif ($segment1 == 'profile') {
                if ($segment2 == 'notifications') {
                    $unifiedUrl = $unifiedUrl . $segment2;
                } elseif (is_numeric($segment2)) {
                    $unifiedUrl = $unifiedUrl . 'profile/' . $segment2 . '/dashboard';
                }
            } elseif ($segment1 == 'settings' && $userId) {
                if (in_array($segment2, ['profile', 'login-credentials', 'payments'])) {
                    $unifiedUrl = $unifiedUrl . 'profile/' . $userId. '/settings/' . $segment2;
                } elseif ($segment2 == 'settings') {
                    $unifiedUrl = $unifiedUrl . 'profile/' . $userId. '/settings/notifications';
                } elseif ($segment2 == 'access') {
                    $unifiedUrl = $unifiedUrl . 'profile/' . $userId. '/settings/account';
                }
            }

            return redirect()->to($unifiedUrl . $authParams);
        }

        if ($segment4 == null) {
            if ($segment1 == 'lessons') {
                if (is_numeric($segment3)) {
                    $content = $this->contentService->getById($segment3);
                    if ($content) {
                        $unifiedUrl = $unifiedUrl . $segment2 . '/' . $content['slug'] . '/' . $content['id'];
                    }
                }
            } elseif ($segment1 == 'semester-packs') {
// logic taken from Unified, SemesterPackController->show()
                $pack = $this->contentService->getBySlugAndType($segment2,'semester-pack')->first();
                if ($pack) {
                    $lessons = $this->contentService->getByParentId($pack['id']);
                    $lessons = new Collection(
                        $lessons->sort(
                            function ($a, $b) {
                                return strtotime($a["published_on"]) - strtotime(
                                        $b["published_on"]
                                    );
                            }
                        )
                            ->values()
                    );

                    if ($segment2 == 'drum-technique-made-easy-april-2019-semester' ||
                        $segment2 == 'rock-drumming-masterclass-july-2019-semester' ||
                        $segment2 == 'rock-drumming-masterclass-pack' ||
                        $segment2 == 'drum-technique-made-easy-pack' ||
                        $segment2 == 'independence-made-easy-pack') {

                        $lessons = new Collection(
                            $lessons->sort(
                                function ($a, $b) {
                                    return $a['child_position'] > $b['child_position'];
                                }
                            )
                                ->values()
                        );
                    }

                    $lesson = null;
                    foreach ($lessons as $index => $semesterLesson) {
                        if ($semesterLesson['slug'] == $segment3) {
                            $lesson = $semesterLesson;
                        }
                    }
                    if ($lesson) {
                        $unifiedUrl = $unifiedUrl . $segment1 . '/' . $segment2 . "/" . $pack['id'] . '/' . $segment3 . "/"  . $lesson['id'] ;

                    }
                }
            } elseif ($segment1 == 'packs') {
                $pack = $this->contentService->getBySlugAndType($segment2,'pack')->first();
                $packBundle = $this->contentService->getBySlugAndType($segment3,'pack-bundle')->first();
                if ($pack && $packBundle) {
                    $unifiedUrl = $unifiedUrl . $segment1 . '/' . $segment2 . "/" . $pack['id'] . '/' . $segment3 . "/"  . $packBundle['id'] ;
                }
            } elseif ($segment1 == 'learning-paths') {
                $learningPath = $this->contentService->getBySlugAndType($segment2,'learning-path')->first();
                $learningPathLevel = $this->contentService->getBySlugAndType($segment3,'learning-path-level')->first();
                if ($learningPath && $learningPathLevel) {
                    $unifiedUrl = $unifiedUrl  . 'method/' . $segment2 . "/" . $learningPath['id'] . '/' . $segment3 . "/"  . $learningPathLevel['id'] ;
                }
            } elseif ($segment1 == 'profile' && $userId) {
                if ($segment2 == $userId && $segment3 == 'lists') {
                    $unifiedUrl = $unifiedUrl . 'lists/my-list';
                }
            }

            return redirect()->to($unifiedUrl . $authParams);

        }

        if ($segment5 == null) {
            if ($segment1 == 'coaches') {
//todo!
// drumeo.com: https://www.drumeo.com/members/coaches/jared-falk/11-iconic-drum-beats/321029
// could not find yet link for musora.com/drumeo
            } elseif ($segment1 == 'packs') {
                //https://dev.drumeo.com/members/packs/new-drummers-start-here/the-drum-setup-system/welcome
                //https://devplatform.musora.com:8443/drumeo/packs/new-drummers-start-here/299812/the-drum-setup-system/299813/welcome/299814
                $pack = $this->contentService->getBySlugAndType($segment2,'pack')->first();
                $packBundle = $this->contentService->getBySlugAndType($segment3,'pack-bundle')->first();
                $packBundleLesson = $this->contentService->getBySlugAndType($segment4,'pack-bundle-lesson')->first();

                if ($pack && $packBundle && $packBundleLesson) {
                    $unifiedUrl = $unifiedUrl . "packs/" . $segment2 . "/" . $pack['id'] . "/" . $segment3 . "/" . $packBundle['id'] .
                        "/" . $segment4 . "/" . $packBundleLesson['id'];
                }
            }

            return redirect()->to($unifiedUrl);
        }

        if ($segment6 == null) {
            if ($segment1 == 'learning-paths') {
                $learningPath = $this->contentService->getBySlugAndType($segment2,'learning-path')->first();
                $learningPathLevel = $this->contentService->getBySlugAndType($segment3,'learning-path-level')->first();
                if ($learningPath && $learningPathLevel) {
                    $unifiedUrl = $unifiedUrl  . 'method/' . $segment2 . "/" . $learningPath['id'] . '/' .
                        $segment3 . "/"  . $learningPathLevel['id'] . "/" .  $segment4 . "/" . $segment5;
                }
            }

            return redirect()->to($unifiedUrl . $authParams);
        }

        if ($segment8 == null) {
            if ($segment1 == 'learning-paths') {
                $learningPath = $this->contentService->getBySlugAndType($segment2, 'learning-path')->first();
                $learningPathLevel = $this->contentService->getBySlugAndType($segment3, 'learning-path-level')->first();
                if ($learningPath && $learningPathLevel) {
                    $unifiedUrl = $unifiedUrl . 'method/' . $segment2 . "/" . $learningPath['id'] . '/' .
                        $segment3 . "/" . $learningPathLevel['id'] . "/" . $segment4 . "/" .
                        $segment5 . "/" . $segment6 . "/" . $segment7;
                }
            }

            return redirect()->to($unifiedUrl . $authParams);
        }

        return redirect()->to($unifiedUrl . $authParams);
    }

    public function redirectPianote(
        $domain,
        $segment1 = null,
        $segment2 = null,
        $segment3 = null,
        $segment4 = null,
        $segment5 = null,
        $segment6 = null,
        $segment7 = null,
        $segment8 = null
    ) {
        $userId = null;
        $authParams = null;

        if (user()) {
            $userId = user()->getId();
            $authParams = '';
        }

        $unifiedUrl = get_musora_brand_base_url() . '/pianote/';

        if ($segment1 == null) {
            return redirect()->to($unifiedUrl . $authParams);
        }


        if (in_array($segment1, [
            'forums',
            'referral',
            'support',
            'live',
            'schedule',
            'legacy-resources',
            'search',
            'courses',
            'songs',
            'quick-tips',
            'student-reviews',
            'question-and-answer',
            'podcasts',
            'boot-camps'
        ])) {
            $segment1 = ($segment1 == 'boot-camps') ? "bootcamps" : $segment1;

            /* here we treat all the routes that are similar */
            $unifiedUrl = $unifiedUrl . $segment1 . "/";
            foreach ([$segment2, $segment3, $segment4, $segment5] as $segment) {
                if ($segment) {
                    $unifiedUrl = $unifiedUrl . $segment . "/";
                } else {
                    break;
                }
            }
            return redirect()->to($unifiedUrl . $authParams);
        }

        if ($segment2 == null) {
            if (in_array($segment1, ['packs', 'coaches', 'student-focus'])) {
                $unifiedUrl = $unifiedUrl . $segment1;
            }
            if ($segment1 == 'chat') {
                $unifiedUrl = $unifiedUrl . 'live-chat';
            } elseif ($segment1 == 'profile' && $userId) {
                $unifiedUrl = $unifiedUrl . 'profile/' . $userId . '/dashboard';
            }

            return redirect()->to($unifiedUrl . $authParams);
        }

        if ($segment3 == null) {
            if ($segment1 == 'coaches') {
                $content = $this->contentService->getBySlugAndType($segment2, 'instructor')->first();
                if ($content) {
                    $unifiedUrl = $unifiedUrl . 'coaches/' . $segment2 . '/' . $content['id'];
                }
            } elseif ($segment1 == 'lessons') {
                if (in_array($segment2, ['all', 'subscribed'])) {
                    $unifiedUrl = $unifiedUrl . 'lessons/' . $segment2;
                } else {
                    $unifiedUrl = $unifiedUrl . $segment2;
                }
            } elseif ($segment1 == 'semester-packs') {
                $content = $this->contentService->getBySlugAndType($segment2, 'semester-pack')->first();
                if ($content) {
                    $unifiedUrl = $unifiedUrl . 'semester-packs/' . $segment2 . '/' . $content['id'];
                }
            } elseif ($segment1 == 'packs') {
                $content = $this->contentService->getBySlugAndType($segment2, 'pack')->first();
                if ($content) {
                    $unifiedUrl = $unifiedUrl . 'packs/' . $segment2 . '/' . $content['id'];
                }
            } elseif ($segment1 == 'learning-paths') {
                $content = $this->contentService->getBySlugAndType($segment2, 'learning-path')->first();
                if ($content) {
                    $unifiedUrl = $unifiedUrl . 'method/' . $segment2 . '/' . $content['id'];
                }
            } elseif ($segment1 == 'profile') {
                if ($segment2 == 'notifications') {
                    $unifiedUrl = $unifiedUrl . $segment2;
                } elseif ($segment2 == 'lists') {
                    $unifiedUrl = $unifiedUrl . 'lists/my-list';
                } elseif (is_numeric($segment2)) {
                    $unifiedUrl = $unifiedUrl . 'profile/' . $segment2 . '/dashboard';
                }
            } elseif ($segment1 == 'settings' && $userId) {
                if (in_array($segment2, ['profile', 'login-credentials', 'payments'])) {
                    $unifiedUrl = $unifiedUrl . 'profile/' . $userId . '/settings/' . $segment2;
                } elseif ($segment2 == 'settings') {
                    $unifiedUrl = $unifiedUrl . 'profile/' . $userId . '/settings/notifications';
                } elseif ($segment2 == 'access') {
                    $unifiedUrl = $unifiedUrl . 'profile/' . $userId . '/settings/account';
                }
            }

            return redirect()->to($unifiedUrl . $authParams);
        }

        if ($segment4 == null && $segment1 == 'learning-paths') {
            $learningPath = $this->contentService->getBySlugAndType($segment2,'learning-path')->first();
            $learningPathLevel = $this->contentService->getBySlugAndType($segment3,'learning-path-level')->first();
            if ($learningPath && $learningPathLevel) {
                $unifiedUrl = $unifiedUrl  . 'method/' . $segment2 . "/" . $learningPath['id'] . '/' . $segment3 . "/"  . $learningPathLevel['id'] ;
            }
            return redirect()->to($unifiedUrl . $authParams);
        }

        if ($segment5 == null) {
            if ($segment1 == 'packs') {
                $pack = $this->contentService->getBySlugAndType($segment2, 'pack')->first();
                $packBundle = $this->contentService->getBySlugAndType($segment3, 'pack-bundle')->first();
                if ($pack && $packBundle) {
                    $unifiedUrl = $unifiedUrl . "packs/" . $segment2 . "/" . $pack['id'] . "/" . $segment3 . "/" . $packBundle['id'] .
                        "/" . $segment3 . "/" . $segment4;
                }
            }
            return redirect()->to($unifiedUrl);
        }

        if ($segment6 == null) {
            if ($segment1 == 'learning-paths') {
                $learningPath = $this->contentService->getBySlugAndType($segment2, 'learning-path')->first();
                $learningPathLevel = $this->contentService->getBySlugAndType($segment3, 'learning-path-level')->first();
                if ($learningPath && $learningPathLevel) {
                    $unifiedUrl = $unifiedUrl . 'method/' . $segment2 . "/" . $learningPath['id'] . '/' .
                        $segment3 . "/" . $learningPathLevel['id'] . "/" . $segment4 . "/" . $segment5;
                }
            }
            return redirect()->to($unifiedUrl . $authParams);
        }

        // not sure if this is needed
        if ($segment8 == null) {
            if ($segment1 == 'learning-paths') {
                $learningPath = $this->contentService->getBySlugAndType($segment2, 'learning-path')->first();
                $learningPathLevel = $this->contentService->getBySlugAndType($segment3, 'learning-path-level')->first();
                if ($learningPath && $learningPathLevel) {
                    $unifiedUrl = $unifiedUrl . 'method/' . $segment2 . "/" . $learningPath['id'] . '/' .
                        $segment3 . "/" . $learningPathLevel['id'] . "/" . $segment4 . "/" .
                        $segment5 . "/" . $segment6 . "/" . $segment7;
                }
            }

            return redirect()->to($unifiedUrl . $authParams);
        }

        return redirect()->to($unifiedUrl . $authParams);
    }

    public function redirectGuitareo(
        $domain,
        $segment1 = null,
        $segment2 = null,
        $segment3 = null,
        $segment4 = null,
        $segment5 = null,
        $segment6 = null,
        $segment7 = null,
        $segment8 = null
    ) {
        $userId = null;
        $authParams = null;

        if (user()) {
            $userId = user()->getId();
        }

        $unifiedUrl = get_musora_brand_base_url() . '/guitareo/';

        if ($segment1 == null) {
            return redirect()->to($unifiedUrl . $authParams);
        }

        if (in_array($segment1, ['forums', 'referral', 'support', 'live', 'schedule', 'legacy-resources', 'search'])) {
            /* here we treat all the routes that are similar */
            $unifiedUrl = $unifiedUrl . $segment1 . "/";
            foreach ([$segment2, $segment3, $segment4, $segment5] as $segment) {
                if ($segment) {
                    $unifiedUrl = $unifiedUrl . $segment . "/";
                } else {
                    break;
                }
            }
            return redirect()->to($unifiedUrl . $authParams);
        }

        if ($segment2 == null) {
            if (in_array(
                $segment1,
                [
                    'packs',
                    'coaches',
                    'songs',
                    'quick-tips',
                    'student-focus',
                    'lessons',
                    'chords-scales',
                    'student-reviews'
                ]
            )) {
                $unifiedUrl = $unifiedUrl . $segment1;
            }
            if ($segment1 == 'chat') {
                $unifiedUrl = $unifiedUrl . 'live-chat';
            } elseif ($segment1 == 'course') {
                $unifiedUrl = $unifiedUrl . 'courses';
            } elseif ($segment1 == 'profile' && $userId) {
                $unifiedUrl = $unifiedUrl . 'profile/' . $userId . '/dashboard';
            } elseif ($segment1 == 'play-along') {
                $unifiedUrl = $unifiedUrl . 'play-alongs';
            } elseif ($segment1 == 'archive') {
                $unifiedUrl = $unifiedUrl . 'archives';
            } elseif (in_array($segment1, ['archives', 'loops', 'dictionary-of-terms'])) {
                $unifiedUrl = $unifiedUrl . 'legacy-resources/' . $segment1;
            }

            return redirect()->to($unifiedUrl . $authParams);
        }

        if ($segment3 == null) {
            if ($segment1 == 'coaches') {
                $content = $this->contentService->getBySlugAndType($segment2, 'instructor')->first();
                if ($content) {
                    $unifiedUrl = $unifiedUrl . 'coaches/' . $segment2 . '/' . $content['id'];
                }
            } elseif ($segment1 == 'settings' && $userId) {
                if (in_array($segment2, ['profile', 'login-credentials', 'payments'])) {
                    $unifiedUrl = $unifiedUrl . 'profile/' . $userId . '/settings/' . $segment2;
                } elseif ($segment2 == 'settings') {
                    $unifiedUrl = $unifiedUrl . 'profile/' . $userId . '/settings/notifications';
                } elseif ($segment2 == 'access') {
                    $unifiedUrl = $unifiedUrl . 'profile/' . $userId . '/settings/account';
                }
            } elseif ($segment1 == 'lessons') {
                if (in_array($segment2, ['all', 'subscribed'])) {
                    $unifiedUrl = $unifiedUrl . 'lessons/' . $segment2;
                } else {
                    $unifiedUrl = $unifiedUrl . $segment2;
                }
            } elseif ($segment1 === 'play-along') {
                $content = $this->contentService->getById($segment2);
                if ($content) {
                    $unifiedUrl .= "play-alongs/" . $content['slug'] . "/" . $segment2;
                }
            } elseif ($segment1 == 'course') {
                $content = $this->contentService->getById($segment2);

                if ($content) {
                    $unifiedUrl = $unifiedUrl . "courses" . '/' . $content['slug'] . '/' . $content['id'];
                }
            } elseif ($segment1 == 'play-along') {
                $content = $this->contentService->getById($segment2);

                if ($content) {
                    $unifiedUrl = $unifiedUrl . "play-alongs" . '/' . $content['slug'] . '/' . $content['id'];
                }
            } elseif ($segment1 == 'chord-and-scale') {
                $content = $this->contentService->getById($segment2);
                if ($content) {
                    $unifiedUrl = $unifiedUrl . "chords-scales" . '/' . $content['slug'] . '/' . $content['id'];
                }
            } elseif ($segment1 == 'recording') {
                $content = $this->contentService->getById($segment2);
                if ($content) {
                    $unifiedUrl = $unifiedUrl . "archives" . '/' . $content['slug'] . '/' . $content['id'];
                }
            } elseif ($segment1 == 'course-part') {
                //todo:
//            https://dev.guitareo.com/members/course-part/363972
//            https://dev.musora.com:8443/guitareo/courses/ayla-workouts/363971/workout-1/363972
            } elseif ($segment1 == 'play-along-part') {
                //todo:
//            https://dev.guitareo.com/members/play-along-part/192922
//            https://dev.musora.com:8443/guitareo/method/advanced-lead-guitar/193786/talking-birds-lead/191440/series-overview/192922
            } elseif ($segment1 == 'student-review') {
                $unifiedUrl = $unifiedUrl . 'student-reviews/student-review/' . $segment2;
            } elseif ($segment1 == 'semester-packs') {
                $content = $this->contentService->getBySlugAndType($segment2, 'semester-pack')->first();
                if ($content) {
                    $unifiedUrl = $unifiedUrl . 'semester-packs/' . $segment2 . '/' . $content['id'];
                }
            } elseif ($segment1 == 'packs') {
                $content = $this->contentService->getBySlugAndType($segment2, 'pack')->first();
                if ($content) {
                    $unifiedUrl = $unifiedUrl . 'packs/' . $segment2 . '/' . $content['id'];
                }
            } elseif ($segment1 == 'learning-paths') {
                $content = $this->contentService->getBySlugAndType($segment2, 'learning-path')->first();
                if ($content) {
                    $unifiedUrl = $unifiedUrl . 'method/' . $segment2 . '/' . $content['id'];
                }
            } elseif ($segment1 == 'quick-tips' || 'question-and-answer') {
                $content = $this->contentService->getById($segment2);
                if ($content) {
                    $unifiedUrl = $unifiedUrl . $segment1 . '/' . $content['slug'] . '/' . $content['id'];
                }
            } elseif ($segment1 == 'profile') {
                if ($segment2 == 'notifications') {
                    $unifiedUrl = $unifiedUrl . $segment2;
                } elseif (is_numeric($segment2)) {
                    $unifiedUrl = $unifiedUrl . 'profile/' . $segment2 . '/dashboard';
                }
            }

            return redirect()->to($unifiedUrl . $authParams);
        }

        if ($segment4 == null) {
            if ($segment1 == 'lessons') {
                if (in_array($segment2, ['rudiments', 'courses', 'songs', 'student-focus'])) {
                    if (is_numeric($segment3)) {
                        $content = $this->contentService->getById($segment3);
                        if ($content) {
                            $unifiedUrl = $unifiedUrl . $segment2 . '/' . $content['slug'] . '/' . $content['id'];
                        }
                    }
                }
            } elseif ($segment1 === 'semester-pack') {
                $unifiedUrl .= 'semester-packs/' . $segment2 . '/' . $segment3;
            } elseif ($segment1 == 'account') {
                if (is_numeric($segment2) && $segment3 == 'playlists') {
                    $unifiedUrl = $unifiedUrl . "lists/my-list";
                }
            } elseif ($segment1 == 'semester-packs') {
// logic taken from Unified, SemesterPackController->show()
                $pack = $this->contentService->getBySlugAndType($segment2, 'semester-pack')->first();
                if ($pack) {
                    $lessons = $this->contentService->getByParentId($pack['id']);
                    $lessons = new Collection(
                        $lessons->sort(
                            function ($a, $b) {
                                return strtotime($a["published_on"]) - strtotime(
                                        $b["published_on"]
                                    );
                            }
                        )
                            ->values()
                    );

                    if ($segment2 == 'drum-technique-made-easy-april-2019-semester' ||
                        $segment2 == 'rock-drumming-masterclass-july-2019-semester' ||
                        $segment2 == 'rock-drumming-masterclass-pack' ||
                        $segment2 == 'drum-technique-made-easy-pack' ||
                        $segment2 == 'independence-made-easy-pack') {
                        $lessons = new Collection(
                            $lessons->sort(
                                function ($a, $b) {
                                    return $a['position'] > $b['position'];
                                }
                            )
                                ->values()
                        );
                    }

                    $lesson = null;
                    foreach ($lessons as $index => $semesterLesson) {
                        if ($semesterLesson['slug'] == $segment3) {
                            $lesson = $semesterLesson;
                        }
                    }
                    if ($lesson) {
                        $unifiedUrl = $unifiedUrl . $segment1 . '/' . $segment2 . "/" . $pack['id'] . '/' . $segment3 . "/" . $lesson['id'];
                    }
                }
            } elseif ($segment1 == 'packs') {
                $pack = $this->contentService->getBySlugAndType($segment2, 'pack')->first();
                $packBundle = $this->contentService->getBySlugAndType($segment3, 'pack-bundle')->first();
                if ($pack && $packBundle) {
                    $unifiedUrl = $unifiedUrl . $segment1 . '/' . $segment2 . "/" . $pack['id'] . '/' . $segment3 . "/" . $packBundle['id'];
                }
            } elseif ($segment1 == 'learning-paths') {
                if (is_numeric($segment3)) {
                    $learningPath = $this->contentService->getBySlugAndType($segment2, 'learning-path')->first();
                    if ($learningPath) {
                        $unifiedUrl .= 'method/' . $segment2 . '/' . $learningPath['id'];
                    }
                }
                $learningPath = $this->contentService->getBySlugAndType($segment2, 'learning-path')->first();
                $learningPathLevel = $this->contentService->getBySlugAndType($segment3, 'learning-path-level')->first();
                if ($learningPath && $learningPathLevel) {
                    $unifiedUrl = $unifiedUrl . 'method/' . $segment2 . "/" . $learningPath['id'] . '/' . $segment3 . "/" . $learningPathLevel['id'];
                }
            }

            return redirect()->to($unifiedUrl . $authParams);
        }

        if ($segment5 == null) {
            if ($segment1 == 'packs') {
                $pack = $this->contentService->getBySlugAndType($segment2, 'pack')->first();
                $packBundle = $this->contentService->getBySlugAndType($segment3, 'pack-bundle')->first();
                $packBundleLesson = $this->contentService->getById($segment4);
                if ($pack && $packBundle && $packBundleLesson) {
                    $unifiedUrl = $unifiedUrl . "packs/" . $segment2 . "/" . $pack['id'] . "/" . $segment3 . "/" . $packBundle['id'] .
                        "/" . $packBundleLesson['slug'] . "/" . $packBundleLesson['id'];

                }
            }

            return redirect()->to($unifiedUrl);
        }

        if ($segment6 == null) {
            if ($segment1 == 'learning-paths') {
                $learningPath = $this->contentService->getBySlugAndType($segment2, 'learning-path')->first();
                $learningPathLevel = $this->contentService->getBySlugAndType($segment3, 'learning-path-level')->first();
                if ($learningPath && $learningPathLevel) {
                    $unifiedUrl = $unifiedUrl . 'method/' . $segment2 . "/" . $learningPath['id'] . '/' .
                        $segment3 . "/" . $learningPathLevel['id'] . "/" . $segment4 . "/" . $segment5;
                }
            }

            return redirect()->to($unifiedUrl . $authParams);
        }

        if ($segment8 == null) {
            if ($segment1 == 'learning-paths') {
                $learningPath = $this->contentService->getBySlugAndType($segment2, 'learning-path')->first();
                $learningPathLevel = $this->contentService->getBySlugAndType($segment3, 'learning-path-level')->first();
                if ($learningPath && $learningPathLevel) {
                    $unifiedUrl = $unifiedUrl . 'method/' . $segment2 . "/" . $learningPath['id'] . '/' .
                        $segment3 . "/" . $learningPathLevel['id'] . "/" . $segment4 . "/" .
                        $segment5 . "/" . $segment6 . "/" . $segment7;
                }
            }

            return redirect()->to($unifiedUrl . $authParams);
        }

        return redirect()->to($unifiedUrl . $authParams);
    }

    public function redirectSingeo(
        $domain,
        $segment1 = null,
        $segment2 = null,
        $segment3 = null,
        $segment4 = null,
        $segment5 = null,
        $segment6 = null,
        $segment7 = null,
        $segment8 = null
    ) {
        $userId = null;
        $authParams = null;

        if (user()) {
            $userId = user()->getId();
            $authParams = '';
        }

        $unifiedUrl = get_musora_brand_base_url() . '/singeo/';

        if ($segment1 == null) {
            return redirect()->to($unifiedUrl . $authParams);
        }

        if (in_array($segment1, [
            'forums',
            'referral',
            'support',
            'live',
            'schedule',
            'legacy-resources',
            'search',
            'quick-tips',
            'routines',
            'courses',
            'songs',
            'student-reviews',
            'question-and-answer'
        ])) {
            /* here we treat all the routes that are similar */
            $unifiedUrl = $unifiedUrl . $segment1 . "/";
            foreach ([$segment2, $segment3, $segment4, $segment5] as $segment) {
                if ($segment) {
                    $unifiedUrl = $unifiedUrl . $segment . "/";
                } else {
                    break;
                }
            }
            return redirect()->to($unifiedUrl . $authParams);
        }

        if ($segment2 == null) {
            if (in_array($segment1, ['packs', 'coaches', 'student-focus'])) {
                $unifiedUrl = $unifiedUrl . $segment1;
            }
            if ($segment1 == 'chat') {
                $unifiedUrl = $unifiedUrl . 'live-chat';
            } elseif ($segment1 == 'profile' && $userId) {
                $unifiedUrl = $unifiedUrl . 'profile/' . $userId . '/dashboard';
            } elseif (in_array($segment1, ['archives', 'loops', 'dictionary-of-terms'])) {
                $unifiedUrl = $unifiedUrl . 'legacy-resources/' . $segment1;
            }

            return redirect()->to($unifiedUrl . $authParams);
        }

        if ($segment3 == null) {
            if ($segment1 == 'profile') {
                if ($segment2 == 'notifications') {
                    $unifiedUrl = $unifiedUrl . $segment2;
                } elseif ($segment2 == 'lists') {
                    $unifiedUrl = $unifiedUrl . 'lists/my-list';
                } elseif (is_numeric($segment2)) {
                    $unifiedUrl = $unifiedUrl . 'profile/' . $segment2 . '/dashboard';
                }
            } elseif ($segment1 == 'settings' && $userId) {
                if (in_array($segment2, ['profile', 'login-credentials', 'payments'])) {
                    $unifiedUrl = $unifiedUrl . 'profile/' . $userId . '/settings/' . $segment2;
                } elseif ($segment2 == 'settings') {
                    $unifiedUrl = $unifiedUrl . 'profile/' . $userId . '/settings/notifications';
                } elseif ($segment2 == 'access') {
                    $unifiedUrl = $unifiedUrl . 'profile/' . $userId . '/settings/account';
                }
            }

            if ($segment1 == 'coaches') {
                $content = $this->contentService->getBySlugAndType($segment2, 'instructor')->first();
                if ($content) {
                    $unifiedUrl = $unifiedUrl . 'coaches/' . $segment2 . '/' . $content['id'];
                }
            } elseif ($segment1 == 'lessons') {
                if (in_array($segment2, ['all', 'subscribed'])) {
                    $unifiedUrl = $unifiedUrl . 'lessons/' . $segment2;
                } else {
                    $unifiedUrl = $unifiedUrl . $segment2;
                }
            } elseif ($segment1 == 'packs') {
                $content = $this->contentService->getBySlugAndType($segment2, 'pack')->first();
                if ($content) {
                    $unifiedUrl = $unifiedUrl . 'packs/' . $segment2 . '/' . $content['id'];
                }
            } elseif ($segment1 == 'learning-paths') {
                $content = $this->contentService->getBySlugAndType($segment2, 'learning-path')->first();
                if ($content) {
                    $unifiedUrl = $unifiedUrl . 'singeo-method/' . $segment2 . '/' . $content['id'];
                }
            }

            return redirect()->to($unifiedUrl . $authParams);
        }


        if ($segment4 == null) {
            if ($segment1 == 'packs') {
                $pack = $this->contentService->getBySlugAndType($segment2, 'pack')->first();
                $packBundle = $this->contentService->getBySlugAndType($segment3, 'pack-bundle')->first();
                if ($pack && $packBundle) {
                    $unifiedUrl = $unifiedUrl . $segment1 . '/' . $segment2 . "/" . $pack['id'] . '/' . $segment3 . "/" . $packBundle['id'];
                }
            } elseif ($segment1 == 'learning-paths') {
                $unifiedUrl = $unifiedUrl . 'method/' . $segment2 . "/" . $segment3;
            }

            return redirect()->to($unifiedUrl . $authParams);
        }

        if ($segment5 == null) {
            if ($segment1 == 'packs') {
                //https://dev.drumeo.com/members/packs/new-drummers-start-here/the-drum-setup-system/welcome
                //https://devplatform.musora.com:8443/drumeo/packs/new-drummers-start-here/299812/the-drum-setup-system/299813/welcome/299814
                $pack = $this->contentService->getBySlugAndType($segment2, 'pack')->first();
                $packBundle = $this->contentService->getBySlugAndType($segment3, 'pack-bundle')->first();
                $packBundleLesson = $this->contentService->getBySlugAndType($segment4, 'pack-bundle-lesson')->first();

                if ($pack && $packBundle && $packBundleLesson) {
                    $unifiedUrl = $unifiedUrl . "packs/" . $segment2 . "/" . $pack['id'] . "/" . $segment3 . "/" . $packBundle['id'] .
                        "/" . $segment4 . "/" . $packBundleLesson['id'];
                }
            }
            return redirect()->to($unifiedUrl);
        }

        if ($segment6 == null) {
            if ($segment1 == 'learning-paths') {
                $learningPath = $this->contentService->getBySlugAndType($segment2, 'learning-path')->first();
                $learningPathLevel = $this->contentService->getBySlugAndType($segment3, 'learning-path-level')->first();
                if ($learningPath && $learningPathLevel) {
                    $unifiedUrl = $unifiedUrl . 'method/' . $segment2 . "/" . $learningPath['id'] . '/' .
                        $segment3 . "/" . $learningPathLevel['id'] . "/" . $segment4 . "/" . $segment5;
                }
            }

            return redirect()->to($unifiedUrl . $authParams);
        }

        if ($segment8 == null) {
            if ($segment1 == 'learning-paths') {
                $learningPath = $this->contentService->getBySlugAndType($segment2, 'learning-path')->first();
                $learningPathLevel = $this->contentService->getBySlugAndType($segment3, 'learning-path-level')->first();
                if ($learningPath && $learningPathLevel) {
                    $unifiedUrl = $unifiedUrl . 'method/' . $segment2 . "/" . $learningPath['id'] . '/' .
                        $segment3 . "/" . $learningPathLevel['id'] . "/" . $segment4 . "/" .
                        $segment5 . "/" . $segment6 . "/" . $segment7;
                }
            }

            return redirect()->to($unifiedUrl . $authParams);
        }

        return redirect()->to($unifiedUrl . $authParams);
    }

}
