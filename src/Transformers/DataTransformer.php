<?php

namespace Railroad\Railcontent\Transformers;

use ArrayAccess;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Support\Collection;

class DataTransformer extends TransformerAbstract
{
    public function transform($data)
    {
        if (is_null($data)) {
            return [];
        }
        if (is_array($data)) {
            return $data;
        }

        if ($data instanceof Collection) {
            $data = $data->toArray();
        }

        $extraColumns = config('railcontent.contentColumnNamesForFields', []);

        foreach ($extraColumns as $extraColumn) {
            if (isset($data[$extraColumn])) {
                unset($data[$extraColumn]);
            }
        }

        foreach ($data as $rowIndex => $row) {
            if ((is_array($row) || $row instanceof ArrayAccess) && isset($row['lessons'])) {
                unset($data[$rowIndex]['lessons']);
            }

            if ((is_array($row) || $row instanceof ArrayAccess) && isset($row['assignments'])) {
                unset($data[$rowIndex]['assignments']);
            }

            if ($rowIndex == 'lessons') {
                unset($data[$rowIndex]);
            }

            if ($rowIndex == 'video') {
                unset($data[$rowIndex]);
            }

            if ($rowIndex == 'assignments') {
                unset($data[$rowIndex]);
            }

            if ($row instanceof Carbon) {
                $data[$rowIndex] = $row->toDateTimeString();
            }
        }

        return $data->getArrayCopy();
    }
}
