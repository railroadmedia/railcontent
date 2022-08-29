<?php

namespace Railroad\Railcontent\Transformers;

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

        foreach ($contentRows as $contentRowIndex => $contentRow) {
            $contentRowCompiledColumnValues = json_decode($contentRow['compiled_view_data'], true);

            // data
            $dataKeyCounts = [];

            foreach ($dataKeys as $dataKey) {
                foreach ($contentRowCompiledColumnValues as $compiledDataKey => $compiledDataValue) {
                    if (!isset($dataKeyCounts[$dataKey])) {
                        $dataKeyCounts[$dataKey] = 0;
                    }

                    if ($compiledDataKey === $dataKey) {
                        $dataKeyCounts[$dataKey]++;

                        $contentRows[$contentRowIndex]['data'][] = [
                            'id' => substr(md5(mt_rand()), 0, 10),
                            'content_id' => $contentRow['id'],
                            'key' => $dataKey,
                            'value' => $compiledDataValue,
                            'position' => $dataKeyCounts[$dataKey],
                        ];
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

                    if ($compiledFieldKey === $fieldKey) {
                        $fieldKeyCounts[$fieldKey]++;

                        $contentRows[$contentRowIndex]['fields'][] = [
                            'id' => substr(md5(mt_rand()), 0, 10),
                            'content_id' => $contentRow['id'],
                            'key' => $fieldKey,
                            'value' => $compiledFieldValue,
                            'position' => $fieldKeyCounts[$fieldKey],
                        ];
                    }
                }
            }
        }


        return $contentRows;
    }
}
