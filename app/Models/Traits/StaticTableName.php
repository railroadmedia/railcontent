<?php

namespace App\Models\Traits;

use Throwable;

trait StaticTableName
{
    /**
     * Get the name of the table for this model
     */
    public static function getTableName(): ?string
    {
        try {
            return with(new static())->getTable();
        } catch (Throwable) {
            return null;
        }
    }
}
