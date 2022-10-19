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
    }
}
