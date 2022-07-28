<?php

namespace App\Maps;

use Railroad\Railcontent\Helpers\ContentHelper;

class DrumeoShowDataMapper
{
    public static function cards()
    {
        $showTypes = array_flip(config('railcontent.showTypes')['drumeo']);

        $showsData = array_intersect_key(array_replace($showTypes, config('railcontent.cataloguesMetadata')['drumeo']), $showTypes);

        // filter out shows with no data set

        foreach ($showsData as $showName => $showData) {
            if (empty($showData['name']) || empty($showData['thumbnailUrl'])) {
                unset($showsData[$showName]);
            }
        }

        return $showsData;
    }

    public static function filterOptions($filterInput, $allFilterOptions)
    {
        $allFilterOptions['instructor'] = $allFilterOptions['instructor'] ?? [];
        $allFilterOptions['level'] = $allFilterOptions['difficulty'] ?? [];
        $allFilterOptions['topic'] = $allFilterOptions['topic'] ?? [];
        $allFilterOptions['required_user_states'] = $allFilterOptions['required_user_states'] ?? [];

        // user state
        $currentRequiredUserState = $filterInput['required_user_states']['completed'][1] ?? '';

        if (empty($currentRequiredUserState)) {
            $currentRequiredUserState = $filterInput['required_user_states']['started'][1] ?? '';
        }

        // instructor
        $instructorFilterOptions = array_combine(
            array_column($allFilterOptions['instructor'] ?? [], 'id'),
            ContentHelper::getFilterOptionsSubContentFieldValue(
                $allFilterOptions['instructor'] ?? [],
                'name'
            )
        );

        $instructorFilterOptions = array_map('ucwords', $instructorFilterOptions);
        asort($instructorFilterOptions);

        $currentInstructorId = $filterInput['required_fields']['instructor'][1];

        $currentInstructorContent = array_combine(
            array_column($allFilterOptions['instructor'], 'id'),
            $allFilterOptions['instructor']
        )[$currentInstructorId];

        $currentInstructorName = ContentHelper::getFieldValue($currentInstructorContent ?? [], 'name');

        asort($allFilterOptions['level']);
        asort($allFilterOptions['topic']);

        // sort levels
        $sortedLevel = [];

        foreach ([
                     "all",
                     "beginner",
                     "intermediate",
                     "advanced",
                 ] as $orderedLevel) {
            if (in_array($orderedLevel, $allFilterOptions['level'])) {
                $sortedLevel[] = $orderedLevel;
            }
        }

        return [
            'levels' => array_combine(
                $sortedLevel ?? [],
                $sortedLevel ?? []
            ),
            'topics' => array_combine(
                $allFilterOptions['topic'] ?? [],
                $allFilterOptions['topic'] ?? []
            ),
            'instructors' => $instructorFilterOptions,
            'drummers' => $instructorFilterOptions,
            'activities' => ['completed' => 'completed', 'started' => 'started'],

            'currentLevel' => $filterInput['required_fields']['level'][1] ?? '',
            'currentTopic' => $filterInput['required_fields']['topic'][1] ?? '',
            'currentInstructor' => $currentInstructorName,
            'currentDrummer' => $currentInstructorName,
            'currentActivity' => $currentRequiredUserState,
        ];
    }
}
