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

    public function transformLessons(array $contentRows = null)
    {
        $dataKeys = config('railcontent.compiled_column_mapping_data_keys', []);
        $fieldKeys = config('railcontent.compiled_column_mapping_field_keys', []);
        $subContentFieldKeys = config('railcontent.compiled_column_mapping_sub_content_field_keys', []);

        foreach($contentRows as $contentRowIndex => $contentRow){
            $lessons = $contentRow['lessons_grouped_by_field'] ?? [];
            $contentRowCompiledColumnValues = json_decode($lessons ?? '', true);
            $contentRowCompiledColumnValues = (array_combine(Arr::pluck($contentRowCompiledColumnValues,'id'),$contentRowCompiledColumnValues));
            $allLessonsCount = count($contentRowCompiledColumnValues);
            $contentRowCompiledColumnValues = (array_slice($contentRowCompiledColumnValues,0,5));
            $contentRows[$contentRowIndex]['all_lessons_count'] = $allLessonsCount;


            if (empty($contentRowCompiledColumnValues)) {
                continue;
            }

            // data
            $dataKeyCounts = [];

            foreach ($dataKeys as $dataKey) {
                foreach($contentRowCompiledColumnValues as $index=>$contentRowCompiledColumnValue) {
                    if(isset($contentRowCompiledColumnValue['compiled_view_data'])) {
                        foreach (
                            $contentRowCompiledColumnValue['compiled_view_data'] as $compiledDataKey =>
                            $compiledDataValue
                        ) {
                            if (in_array(
                                $compiledDataKey,
                                config('railcontent.content_fields_that_are_now_columns_in_the_content_table')
                            )) {
                                $contentRows[$contentRowIndex]['lessons'][$index][$compiledDataKey] =
                                    $compiledDataValue;
                            }

                            if (!isset($dataKeyCounts[$dataKey])) {
                                $dataKeyCounts[$dataKey] = 0;
                            }

                            if ($compiledDataKey === $dataKey) {
                                $compiledDataValue = Arr::wrap($compiledDataValue);

                                foreach ($compiledDataValue as $compiledDataSingleValue) {
                                    $dataKeyCounts[$dataKey]++;
                                    $contentRows[$contentRowIndex]['lessons'][$index]['data'][] = [
                                        'id' => substr(md5(mt_rand()), 0, 10),
                                        'content_id' => $contentRowCompiledColumnValue['compiled_view_data']['id'],
                                        'key' => $dataKey,
                                        'value' => $compiledDataSingleValue,
                                        'position' => 1
                                    ];
                                }
                            }
                        }
                    }
                }
            }

            // fields
            $fieldKeyCounts = [];

            foreach ($fieldKeys as $fieldKey) {
                foreach($contentRowCompiledColumnValues as $index=>$contentRowCompiledColumnValue) {
                    if(isset($contentRowCompiledColumnValue['compiled_view_data'])) {
                        foreach (
                            $contentRowCompiledColumnValue['compiled_view_data'] as $compiledFieldKey =>
                            $compiledFieldValue
                        ) {
                            if (!isset($fieldKeyCounts[$fieldKey])) {
                                $fieldKeyCounts[$fieldKey] = 0;
                            }

                            if ($compiledFieldKey === $fieldKey && !in_array($fieldKey, $subContentFieldKeys)) {
                                $compiledFieldValue = Arr::wrap($compiledFieldValue);

                                foreach ($compiledFieldValue as $compiledFieldSingleValue) {
                                    $fieldKeyCounts[$fieldKey]++;

                                    $contentRows[$contentRowIndex]['lessons'][$index]['fields'][] = [
                                        'id' => substr(md5(mt_rand()), 0, 10),
                                        'content_id' => $contentRowCompiledColumnValue['compiled_view_data']['id'],
                                        'key' => $fieldKey,
                                        'value' => $compiledFieldSingleValue,
                                        'type' => 'string',
                                        'position' => 1,
                                    ];
                                    if (self::$avoidDuplicates) {
                                        unset($contentRows[$contentRowIndex][$fieldKey]);
                                    }
                                }
                            } elseif ($compiledFieldKey === $fieldKey && in_array($fieldKey, $subContentFieldKeys)) {
                                if (isset($compiledFieldValue['id'])) {
                                    // its a single value
                                    $fieldKeyCounts[$fieldKey]++;

                                    $contentEntity = new ContentEntity();
                                    $contentEntity->replace($this->transform([$compiledFieldValue])[0]);

                                    $contentRows[$contentRowIndex]['lessons'][$index]['fields'][] = [
                                        'id' => substr(md5(mt_rand()), 0, 10),
                                        'content_id' => $contentRowCompiledColumnValue['compiled_view_data']['id'],
                                        'key' => $fieldKey,
                                        'value' => $contentEntity,
                                        'type' => 'content',
                                        'position' => 1,
                                    ];
                                    if (self::$avoidDuplicates) {
                                        unset($contentRows[$contentRowIndex][$fieldKey]);
                                    }
                                } elseif (is_array($compiledFieldValue)) {
                                    // there are multiple values
                                    foreach ($compiledFieldValue as $compiledFieldSingleValue) {
                                        if (!is_array($compiledFieldSingleValue)) {
                                            continue;
                                        }

                                        $fieldKeyCounts[$fieldKey]++;

                                        $contentEntity = new ContentEntity();
                                        $contentEntity->replace($this->transform([$compiledFieldSingleValue])[0]);

                                        $contentRows[$contentRowIndex]['lessons'][$index]['fields'][] = [
                                            'id' => substr(md5(mt_rand()), 0, 10),
                                            'content_id' => $contentRowCompiledColumnValue['compiled_view_data']['id'],
                                            'key' => $fieldKey,
                                            'value' => $contentEntity,
                                            'type' => 'content',
                                            'position' => 1,
                                        ];
                                    }
                                    if (self::$avoidDuplicates) {
                                        unset($contentRows[$contentRowIndex][$fieldKey]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $content = collect($contentRows[$contentRowIndex]);
            $contentRows[$contentRowIndex] = $content->only(['data','id','slug','type','fields','url','published_on','brand','lessons','all_lessons_count','web_url_path']);
        }
        return $contentRows;
    }
}
