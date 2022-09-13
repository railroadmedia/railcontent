<?php

namespace Railroad\Railcontent\Transformers;

use Illuminate\Support\Arr;
use Railroad\Railcontent\Entities\ContentEntity;

class ContentCompiledColumnTransformer
{
    public static bool $useCompiledColumnForServingData = true;

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
            $contentRows[$contentRowIndex]['permissions'] = [];

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
                        } else {
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
                        }

                    }
                }
            }
        }

        return $contentRows;
    }
}
