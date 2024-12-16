<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\UserManagementSystem\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AssignUserRole extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'AssignUserRole';

    protected $signature = 'AssignUserRole {userId} {roleName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign a user id a permission role.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $user = User::query()->findOrFail($this->argument('userId'));

        $user->assignRole($this->argument('roleName'));

        $this->info($this->argument('roleName') .
            ' role has been assigned to user id ' . $this->argument('userId'));

        return true;
    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [];
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [];
    }
}
