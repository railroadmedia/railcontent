<?php

namespace Railroad\Railcontent\Tests;

trait SeedDatabase
{
    /**
     * Seeds the database.
     *
     * @return void
     */
    public function seedDatabase()
    {
        if (! SeedDatabaseState::$seeded) {
            $this->runSeeders();

            if (SeedDatabaseState::$seedOnce) {
                SeedDatabaseState::$seeded = true;
            }
        }
    }

    /**
     * Calls specific seeder.
     */
    public function runSeeders()
    {
        $this->artisan('db:seed', ['--class' => 'CoachV2Seeder']);
    }
}