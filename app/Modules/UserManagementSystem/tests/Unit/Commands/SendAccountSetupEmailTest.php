<?php

namespace Modules\UserManagementSystem\Tests\Unit\Commands;

use App\Modules\UserManagementSystem\Jobs\SendAccountSetupEmailJob;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;
use Tests\traits\CreatesReflectionMethod;
use Tests\traits\CreatesReflectionProperty;
