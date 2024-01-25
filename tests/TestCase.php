<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication(): Application
    {
        $this->ensureDatabaseExists();

        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();
        return $app;
    }

    private function ensureDatabaseExists(): void
    {
        $databasePath = __DIR__ . '/../database/testing.sqlite';
        if (!file_exists($databasePath)) {
            file_put_contents($databasePath, '');
        }
    }
}
