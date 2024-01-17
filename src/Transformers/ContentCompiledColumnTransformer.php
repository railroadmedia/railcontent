<?php

namespace Railroad\Railcontent\Transformers;

use Illuminate\Support\Arr;
use Railroad\Railcontent\Entities\ContentEntity;

class ContentCompiledColumnTransformer
{
    public static bool $useCompiledColumnForServingData = true;
    public static bool $avoidDuplicates = false;

    /**
     * @param  array|null  $contentRows
     * @return array
     */
    public function transform(array $contentRows = null)
    {
        if (is_null($contentRows) || empty($contentRows) || !self::$useCompiledColumnForServingData) {
            return [];
        }

        /*
         * fields
         * data
         * permissions
         */

        $dataKeys = config('railcontent.compiled_column_mapping_data_keys', []);
        $fieldKeys = config('railcontent.compiled_column_mapping_field_keys', []);
        $subContentFieldKeys = config('railcontent.compiled_column_mapping_sub_content_field_keys', []);

        foreach ($contentRows as $contentRowIndex => $contentRow) {
            $contentRowCompiledColumnValues = json_decode($contentRow['compiled_view_data'] ?? '', true);

            if (!is_array($contentRow)) {
                continue;
            }

            $contentRows[$contentRowIndex]['data'] = [];
            $contentRows[$contentRowIndex]['fields'] = [];
          //  $contentRows[$contentRowIndex]['permissions'] = [];

            if (empty($contentRowCompiledColumnValues)) {
                continue;
            }

            // data
            $dataKeyCounts = [];

            foreach ($dataKeys as $dataKey) {
                foreach ($contentRowCompiledColumnValues as $compiledDataKey => $compiledDataValue) {
                    if (!isset($dataKeyCounts[$dataKey])) {
                        $dataKeyCounts[$dataKey] = 0;
                    }

                    if ($compiledDataKey === $dataKey) {
                        $compiledDataValue = Arr::wrap($compiledDataValue);

                        foreach ($compiledDataValue as $compiledDataSingleValue) {
                            $dataKeyCounts[$dataKey]++;

                            $contentRows[$contentRowIndex]['data'][] = [
                                'id' => substr(md5(mt_rand()), 0, 10),
                                'content_id' => $contentRow['id'],
                                'key' => $dataKey,
                                'value' => $compiledDataSingleValue,
                                'position' => $dataKeyCounts[$dataKey],
                            ];
                        }
                        if(self::$avoidDuplicates){
                            unset($contentRows[$contentRowIndex][$dataKey]);
                        }
                    }
                }
            }

            // fields
            $fieldKeyCounts = [];

            foreach ($fieldKeys as $fieldKey) {
                foreach ($contentRowCompiledColumnValues as $compiledFieldKey => $compiledFieldValue) {
                    if (!isset($fieldKeyCounts[$fieldKey])) {
                        $fieldKeyCounts[$fieldKey] = 0;
                    }

                    if ($compiledFieldKey === $fieldKey && !in_array($fieldKey, $subContentFieldKeys)) {
                        $compiledFieldValue = Arr::wrap($compiledFieldValue);

                        foreach ($compiledFieldValue as $compiledFieldSingleValue) {
                            $fieldKeyCounts[$fieldKey]++;

                            $contentRows[$contentRowIndex]['fields'][] = [
                                'id' => substr(md5(mt_rand()), 0, 10),
                                'content_id' => $contentRow['id'],
                                'key' => $fieldKey,
                                'value' => $compiledFieldSingleValue,
                                'type' => 'string',
                                'position' => $fieldKeyCounts[$fieldKey],
                            ];
                            if(self::$avoidDuplicates){
                                unset($contentRows[$contentRowIndex][$fieldKey]);
                            }
                        }
                    } elseif ($compiledFieldKey === $fieldKey && in_array($fieldKey, $subContentFieldKeys)) {
                        if (isset($compiledFieldValue['id'])) {
                            // its a single value
                            $fieldKeyCounts[$fieldKey]++;

                            $contentEntity = new ContentEntity();
                            $contentEntity->replace($this->transform([$compiledFieldValue])[0]);

                            $contentRows[$contentRowIndex]['fields'][] = [
                                'id' => substr(md5(mt_rand()), 0, 10),
                                'content_id' => $contentRow['id'],
                                'key' => $fieldKey,
                                'value' => $contentEntity,
                                'type' => 'content',
                                'position' => $fieldKeyCounts[$fieldKey],
                            ];
                            if(self::$avoidDuplicates){
                                unset($contentRows[$contentRowIndex][$fieldKey]);
                            }
                        } elseif(is_array($compiledFieldValue)) {
                            // there are multiple values
                            foreach ($compiledFieldValue as $compiledFieldSingleValue) {
                                if (!is_array($compiledFieldSingleValue)) {
                                    continue;
                                }

                                $fieldKeyCounts[$fieldKey]++;

                                $contentEntity = new ContentEntity();
                                $contentEntity->replace($this->transform([$compiledFieldSingleValue])[0]);

                                $contentRows[$contentRowIndex]['fields'][] = [
                                    'id' => substr(md5(mt_rand()), 0, 10),
                                    'content_id' => $contentRow['id'],
                                    'key' => $fieldKey,
                                    'value' => $contentEntity,
                                    'type' => 'content',
                                    'position' => $fieldKeyCounts[$fieldKey],
                                ];
                            }
                            if(self::$avoidDuplicates){
                                unset($contentRows[$contentRowIndex][$fieldKey]);
                            }
                        }

                    }
                }
            }
        }

        return $contentRows;
    }

    public function transformLessons(array $contentRows, array $dataLookup)
    {
        $dataKeys = config('railcontent.compiled_column_mapping_data_keys', []);
        $fieldKeys = config('railcontent.compiled_column_mapping_field_keys', []);
        $subContentFieldKeys = config('railcontent.compiled_column_mapping_sub_content_field_keys', []);

        foreach($contentRows as $contentRowIndex => $contentRow){
            $lessons = $contentRow['lessons_grouped_by_field'] ?? [];
            $lessonContentIds = explode(',', $lessons);
            $lessonContentIds = array_unique($lessonContentIds);
            $allLessonsCount = count($lessonContentIds);
            $lessonContentIds = (array_slice($lessonContentIds,0,5));
            $contentRows[$contentRowIndex]['all_lessons_count'] = $allLessonsCount;


            if (empty($lessonContentIds)) {
                continue;
            }

            if($contentRow['type'] == 'style' || $contentRow['type'] == 'artist') {
                $contentRows[$contentRowIndex]['data'][] = [
                    'id' => substr(md5(mt_rand()), 0, 10),
                    'content_id' => substr(md5(mt_rand()), 0, 10),
                    'key' => 'head_shot_picture_url',
                    'value' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/challenges.jpg',
                    'type' => 'string',
                    'position' => 1,
                ];
                $contentRows[$contentRowIndex]['fields'][] = [
                    'id' => substr(md5(mt_rand()), 0, 10),
                    'content_id' => substr(md5(mt_rand()), 0, 10),
                    'key' => 'name',
                    'value' => $contentRow['grouped_by_field'],
                    'type' => 'string',
                    'position' => 1,
                ];
            }

            foreach ($lessonContentIds as $index => $contentId) {
                $data = $dataLookup[$contentId] ?? [];
                $contentRowCompiledColumnValue = json_decode($data['compiled_view_data'] ?? '', true);
                if (isset($data['compiled_view_data'])) {
                    foreach (
                        $contentRowCompiledColumnValue as $compiledDataKey =>
                        $compiledDataValue
                    ) {
                        if (in_array(
                            $compiledDataKey,
                            config('railcontent.content_fields_that_are_now_columns_in_the_content_table')
                        )) {
                            $contentRows[$contentRowIndex]['lessons'][$index][$compiledDataKey] =
                                $compiledDataValue;
                        }

                        if (in_array($compiledDataKey, $dataKeys)) {
                            $compiledDataValue = Arr::wrap($compiledDataValue);
                            foreach ($compiledDataValue as $compiledDataSingleValue) {
                                $contentRows[$contentRowIndex]['lessons'][$index]['data'][] = [
                                    'id' => substr(md5(mt_rand()), 0, 10),
                                    'content_id' => $contentRowCompiledColumnValue['id'],
                                    'key' => $compiledDataKey,
                                    'value' => $compiledDataSingleValue,
                                    'position' => 1,
                                ];
                            }
                        }

                        if (in_array($compiledDataKey, $fieldKeys) && !in_array($compiledDataKey, $subContentFieldKeys)) {
                                    $compiledFieldValue = Arr::wrap($compiledDataValue);
                                    foreach ($compiledFieldValue as $compiledFieldSingleValue) {
                                        $contentRows[$contentRowIndex]['lessons'][$index]['fields'][] = [
                                            'id' => substr(md5(mt_rand()), 0, 10),
                                            'content_id' => $contentRowCompiledColumnValue['id'],
                                            'key' => $compiledDataKey,
                                            'value' => $compiledFieldSingleValue,
                                            'type' => 'string',
                                            'position' => 1,
                                        ];
                                    }
                                } elseif (in_array($compiledDataKey, $fieldKeys) && in_array($compiledDataKey, $subContentFieldKeys)) {
                                    if (isset($compiledDataValue['id'])) {
                                        $contentEntity = new ContentEntity();
                                        $contentEntity->replace($this->transform([$compiledDataValue])[0]);

                                        $contentRows[$contentRowIndex]['lessons'][$index]['fields'][] = [
                                            'id' => substr(md5(mt_rand()), 0, 10),
                                            'content_id' => $contentRowCompiledColumnValue['id'],
                                            'key' => $compiledDataKey,
                                            'value' => $contentEntity,
                                            'type' => 'content',
                                            'position' => 1,
                                        ];

                                    } elseif (is_array($compiledDataValue)) {
                                        // there are multiple values
                                        foreach ($compiledDataValue as $compiledFieldSingleValue) {
                                            if (!is_array($compiledFieldSingleValue)) {
                                                continue;
                                            }

                                            $contentEntity = new ContentEntity();
                                            $contentEntity->replace($this->transform([$compiledFieldSingleValue])[0]);

                                            $contentRows[$contentRowIndex]['lessons'][$index]['fields'][] = [
                                                'id' => substr(md5(mt_rand()), 0, 10),
                                                'content_id' => $contentRowCompiledColumnValue['id'],
                                                'key' => $compiledDataKey,
                                                'value' => $contentEntity,
                                                'type' => 'content',
                                                'position' => 1,
                                            ];
                                        }
                                    }
                                }
                    }
                }
            }

        }

        return $contentRows;
    }
}
