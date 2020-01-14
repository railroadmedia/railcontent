<?php

namespace Railroad\Railcontent\Support;

use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Entities\Entity;

class Collection extends \Illuminate\Support\Collection
{
    /**
     * @param string|callable $columnToCheckOrCallback
     * @param bool $valueToCheckAgainst
     * @param $default
     * @return null|array|ContentEntity
     */
    public function getFirstIterativeMatch($columnToCheckOrCallback, $valueToCheckAgainst = false, $default = null)
    {
        foreach ($this->items as $itemIndex => $item) {
            if (is_callable($columnToCheckOrCallback) &&
                call_user_func($columnToCheckOrCallback, $valueToCheckAgainst) === $valueToCheckAgainst) {
                return $item;
            } elseif ($item[$columnToCheckOrCallback] === $valueToCheckAgainst) {
                return $item;
            }
        }

        return $default;
    }

    /**
     * @param $fetchString
     * @return int
     */
    public function sumFetched($fetchString)
    {
        $sum = 0;

        foreach ($this->items as $itemIndex => $item) {
            $sum += (integer)$item->fetch($fetchString, 0);
        }

        return $sum;
    }

    /**
     * @param $match
     * @param int $offset
     * @return null|array|ContentEntity
     */
    public function getMatchOffset($match, $offset = 0)
    {
        $itemValues = $this->values();

        foreach ($itemValues as $itemIndex => $item) {
            if ($item == $match && isset($itemValues[$itemIndex + $offset])) {
                return $itemValues[$itemIndex + $offset];
            }
        }

        return null;
    }

    /**
     * @param $key
     * @param string $direction
     * @return Collection
     */
    public function sortByFieldValue($key, $direction = 'asc')
    {
        return $this->sort(
            function ($a, $b) use ($key, $direction) {
                $aValue = null;

                foreach (($a['fields']) as $field) {
                    if ($field['key'] == $key) {
                        $aValue = $field['value'];
                    }
                }

                $bValue = null;

                foreach (($b['fields'] ?? []) as $field) {
                    if ($field['key'] == $key) {
                        $bValue = $field['value'];
                    }
                }

                if ($direction == 'asc') {
                    return $aValue > $bValue;
                }

                return $aValue < $bValue;
            }
        );
    }
}