<?php

namespace Railroad\Railcontent\Transformers;

class ContentCompiledColumnTransformer
{
    public static bool $useCompiledColumnForServingData = true;

    /**
     * @param array|null $contentRows
     * @return array
     */
    public function transform(array $contentRows = null)
    {
        if (is_null($contentRows) || empty($contentRows) || !self::$useCompiledColumnForServingData) {
            return [];
        }

        dd($contentRows);

        return $contentRows;
    }
}
