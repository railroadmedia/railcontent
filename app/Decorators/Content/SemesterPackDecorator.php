<?php

namespace App\Decorators\Content;

use Carbon\Carbon;
use Railroad\Railcontent\Support\Collection;

class SemesterPackDecorator extends TypeDecoratorBase
{
    /**
     * @param Collection $contents
     * @return Collection
     */
    public function decorate(Collection $contents)
    {
        // url
        $contentsOfType = $contents->where('type', 'semester-pack');

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        foreach ($contentsOfType as $contentIndex => $content) {
            if (($content['completed'] ?? false) !== true) {
                $contentsOfType[$contentIndex]['next_lesson_url'] =
                    url()->route('platform.content.jump-to-continue-content', [$content['id']]);
            }
            $enrollStarted = !empty($content->fetch('enrollment_start_time')) && Carbon::parse($content->fetch('enrollment_start_time')) <= Carbon::now();
            $enrollEnded = !empty($content->fetch('enrollment_end_time')) && Carbon::parse($content->fetch('enrollment_end_time')) <= Carbon::now();
            $registrationUrl = $content->fetch('fields.registration_url');
            $enrollNow = $registrationUrl && $enrollStarted && !$enrollEnded;
            $contentsOfType[$contentIndex]['enrollment_state'] = $enrollNow ? 'open' : 'closed';
            $isStarted = $content['started'] && !$content['completed'];
            $isCompleted = $content['completed'];
            $contentsOfType[$contentIndex]['primary_cta_text'] = $enrollNow ? 'Enroll Now' : ((!$isStarted) ? 'Start' : (($isCompleted) ? 'Completed' : ' Continue'));
            $contentsOfType[$contentIndex]['primary_cta_url'] = $enrollNow ? $registrationUrl : $contentsOfType[$contentIndex]['next_lesson_url'];

            //strip <p> tags from description
            $contentData = $content['data'] ?? [];
            foreach ($contentData as $index => $data) {
                if(in_array($data['key'] ,['description'])){
                    $contentsOfType[$contentIndex]['data'][$index]['value'] = strip_tags(html_entity_decode($data['value']), '<a>,<em>,<strong>');
                }
            }

        }

        if (self::$decorationMode !== self::DECORATION_MODE_MAXIMUM) {
            return $this->mergeDecorated($contents, $contentsOfType);
        }

        // everything else
        $childCounts = $this->contentHierarchyService->countParentsChildren(
            $contents->pluck('id')
                ->toArray()
        );

        $lessonHierarchies = $this->contentHierarchyService->getByParentIds(
            $contents->pluck('id')
                ->toArray()
        );

        foreach ($contentsOfType as $contentIndex => $content) {
            if (in_array(
                $content['slug'],
                ['drum-technique-made-easy-pack', 'independence-made-easy-pack', 'rock-drumming-masterclass-pack']
            )) {
                $contentsOfType[$contentIndex]['included_with_edge'] = true;
            }

            if (!isset($contentsOfType[$contentIndex]['xp'])) {
                $contentsOfType[$contentIndex]['xp'] = 0;
            }

            if (!isset($contentsOfType[$contentIndex]['xp_bonus'])) {
                $contentsOfType[$contentIndex]['xp_bonus'] = 0;
            }

            $contentsOfType[$contentIndex]['xp'] += $content->fetch(
                'fields.xp',
                config('xp_ranks.pack_content_completed')
            );

            $contentsOfType[$contentIndex]['xp_bonus'] += $content->fetch(
                'fields.xp',
                config('xp_ranks.pack_content_completed')
            );

            $contentsOfType[$contentIndex]['lesson_count'] = $childCounts[$content['id']] ?? 0;

            foreach ($lessonHierarchies as $lessonHierarchy) {
                if ($lessonHierarchy['parent_id'] == $content['id']) {
                    if (!isset($contentsOfType[$contentIndex]['xp'])) {
                        $contentsOfType[$contentIndex]['xp'] = 0;
                    }
                    $contentsOfType[$contentIndex]['xp'] += config('xp_ranks.difficulty_xp_map.all');
                }
            }

            if (!empty($content['total_xp'])) {
                $contentsOfType[$contentIndex]['xp'] = $content['total_xp'];
            }
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
