<?php

namespace App\Console\Commands;

use Modules\UserManagementSystem\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Spatie\Permission\Models\Role;
use Exception;

class PopulateUserRolesTable extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'PopulateUserRolesTable';

    protected $signature = 'PopulateUserRolesTable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate new roles table, permission_model_has_roles, with roles from old user_roles table.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(DatabaseManager $databaseManager)
    {
        print_r("##### PopulateUserRolesTable command starts now ######\n");

        $dbConn = $databaseManager->connection(config('railcontent.database_connection_name'));

        $userRoles = $dbConn->table('user_roles')->select('*')->get()->toArray();

        foreach ($userRoles as $userRole) {
            try {
                $user = User::find($userRole->user_id);
                $role = Role::findByName($userRole->role);
                $user->assignRole($role);
            } catch (Exception $e) {
                print_r(
                    "Role name " . $userRole->role . " cannot be assigned to user id " . $userRole->user_id . " \n"
                );
            }
        }

        print_r("##### PopulateUserRolesTable command has finished ####\n");
    }


}
