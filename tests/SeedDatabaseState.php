<?php

namespace Railroad\Railcontent\Tests;

class SeedDatabaseState
{
    /**
     * Indicates if the test database has been seeded.
     *
     * @var bool
     */
    public static $seeded = false;

    /**
     * Indicates if the seeders should run once at the beginning of the suite.
     *
     * @var bool
     */
    public static $seedOnce = true;
}