<?php

namespace Railroad\Railcontent\Entities;

class CommentEntity extends Entity
{
    public function dot()
    {
        $data = $this->getArrayCopy();

        return array_merge($this->dotKeepFullArrays($data, '', '*'));
    }

    /**
     * Flatten a multi-dimensional associative array with dots.
     *
     * @param  array $array
     * @param  string $prepend
     * @param $arrayPrepend
     * @return array
     */
    private function dotKeepFullArrays($array, $prepend = '', $arrayPrepend)
    {
        $results = [];

        foreach ($array as $key => $value) {
            if (is_array($value) && !empty($value)) {
                $results = array_merge(
                    $results,
                    $this->dotKeepFullArrays($value, $prepend . $key . '.', $arrayPrepend . $key . '.')
                );
                $results[$arrayPrepend . $key] = $value;
            } else {
                $results[$prepend . $key] = $value;
            }
        }

        return $results;
    }
}