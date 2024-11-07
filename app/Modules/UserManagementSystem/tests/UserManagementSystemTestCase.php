<?php

namespace Modules\UserManagementSystem\Tests;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

abstract class UserManagementSystemTestCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Mail::fake();
        Notification::fake();
        // disable railtracker middleware because it doesn't work with the testing environment
        $this->withoutMiddleware([\Railroad\Railtracker\Middleware\RailtrackerMiddleware::class]);
    }
}
