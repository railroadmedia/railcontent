<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Services\ContentFollowsService;
use Railroad\Railcontent\Support\Collection;

class InstructorDecorator extends ModeDecoratorBase
{
    /**
     * @var ContentFollowsService
     */
    protected $contentFollowsService;

    private static $cache = [];

    /**
     * @param ContentFollowsService $contentFollowsService
     */
    public function __construct(
        ContentFollowsService $contentFollowsService
    ) {
        $this->contentFollowsService = $contentFollowsService;
    }

    public function decorate(Collection $contents)
    {
        if (self::$decorationMode !== self::DECORATION_MODE_MAXIMUM) {
            foreach ($contents as $contentIndex => $content) {
                if ($content instanceof ContentEntity) {
                    $contents[$contentIndex]['instructors'] = [];
                    foreach ($content['fields'] as $field) {
                        if ($field['key'] === 'instructor') {
                            $coachName = $field['value']->fetch('fields.name');

                            if (!in_array($coachName, $contents[$contentIndex]['instructors'] ?? [])) {
                                $contents[$contentIndex]['instructors'][] = $coachName;
                            }
                        }
                    }
                }
            }

            return $contents;
        }

        if (!user()) {
            return $contents;
        }

        if (key_exists(user()->id, self::$cache)) {
            $userSubscribedContents = self::$cache[user()->id];
        } else {
            $userSubscribedContents = $this->contentFollowsService->getCurrentUserFollowedContentIds();
            self::$cache[user()->id] = $userSubscribedContents;
        }

        foreach ($contents as $contentIndex => $content) {
            $contents[$contentIndex]['instructors'] = [];
            $coaches = [];

            foreach ($content['fields'] as $field) {
                if ($field['key'] === 'instructor') {
                    $coachName = $field['value']->fetch('fields.name');
                    if (!in_array($coachName, $contents[$contentIndex]['instructors'])) {
                        $contents[$contentIndex]['instructors'][] = $coachName;
                    }

                    $coach = $field['value']->getArrayCopy();
                    $coach['current_user_is_subscribed'] = in_array($coach['id'], $userSubscribedContents);
                    $coach['coach_profile_image'] = $field['value']->fetch('data.head_shot_picture_url');
                    $coach['name'] = $coachName;
                    $coach['url'] = url()->route('platform.content.coach.show', [$coach['slug'], $coach['id']]);
                    $coaches[$coach['id']] = $coach;
                }
            }
            $contents[$contentIndex]['coaches'] = array_values($coaches);

            if ($content['type'] == 'instructor') {
                $contents[$contentIndex]['url'] =
                    url()->route('platform.content.coach.show', [$content['slug'], $content['id']]);

                //                $contents[$contentIndex]['mobile_app_url'] =
                //                    url()->route('mobile.musora-api.content.show', [$content['id']]);

                $contents[$contentIndex]['current_user_is_subscribed'] =
                    in_array($content['id'], $userSubscribedContents);

                $contents[$contentIndex]['focus'] = $content->fetch('*fields.focus.value');
                $contents[$contentIndex]['genre'] = $content->fetch('*fields.style.value');
                $contents[$contentIndex]['bands'] = $content->fetch('*fields.bands.value');
                $contents[$contentIndex]['endorsements'] = $content->fetch('*fields.endorsements.value');

                $contents[$contentIndex]['coach_card_image'] = $content->fetch('data.coach_card_image');
                $contents[$contentIndex]['coach_bottom_banner_image'] =
                    $content->fetch('data.coach_bottom_banner_image');
                $contents[$contentIndex]['coach_top_banner_image'] = $content->fetch('data.coach_top_banner_image');
                $contents[$contentIndex]['coach_profile_image'] = $content->fetch('data.head_shot_picture_url');
                $contents[$contentIndex]['coach_featured_image'] = $content->fetch('data.coach_featured_image');
                $contents[$contentIndex]['short_bio'] = $content->fetch('data.short_bio');
                $contents[$contentIndex]['long_bio'] = $content->fetch('data.long_bio');
                $contents[$contentIndex]['is_house_coach'] = $content->fetch('fields.is_house_coach', 0);

                // this is a hack that only runs this for mobile app json requests
                if (strpos(request()->path(), 'musora-api') !== false) {
                    $contents[$contentIndex]['short_bio'] = str_replace(
                        '<br>',
                        '
',
                        $content->fetch('data.short_bio')
                    );
                    $contents[$contentIndex]['long_bio'] = str_replace(
                        '<br>',
                        '
',
                        $content->fetch('data.long_bio')
                    );
                }

                $forumThreadId = $content->fetch('fields.forum_thread_id', null);
                $contents[$contentIndex]['forum_thread_id'] = $forumThreadId;
                if ($forumThreadId) {
                    // todo: railforums
                    //                    $contents[$contentIndex]['forum_thread'] =  $this->railforumProvider->getThreadById($forumThreadId);
                    //                    $contents[$contentIndex]['forum_thread']['url'] = url()->route('forums.thread.jump-to',$forumThreadId);
                }
            }

            $lessons = $content['lessons'] ?? [];

            foreach ($lessons as $lessonIndex => $lesson) {
                $difficulty = $lesson['difficulty'] ?? '';
                switch ($difficulty) {
                    case ($difficulty == 1):
                        $difficultyString = 'Novice';
                        break;
                    case ($difficulty > 1 && $difficulty <= 3):
                        $difficultyString = 'Beginner';
                        break;
                    case ($difficulty > 3 && $difficulty <= 5):
                        $difficultyString = 'Intermediate';
                        break;
                    case ($difficulty > 5 && $difficulty <= 7):
                        $difficultyString = 'Advanced';
                        break;
                    case ($difficulty > 7):
                        $difficultyString = 'Expert';
                        break;
                    default:
                        $difficultyString = $difficulty;
                        break;
                }
                $contents[$contentIndex]['lessons'][$lessonIndex]['difficulty_string'] = $difficultyString;
            }
        }

        return $contents;
    }
}
