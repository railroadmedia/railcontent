<?php

use App\Modules\Ecommerce\Models\UserAccessPermission;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        // SQLite doesn't allow us to modify the enum options, so these have already been applied in 2023_09_19_161817_ecommerce_user_permissions.php
        if (Schema::getConnection()->getDriverName() !== "sqlite") {
            DB::statement(
                "ALTER TABLE user_access_permissions
                    MODIFY COLUMN source ENUM('manual', 'shopify', 'web', 'access-code', 'challenges', 'apple', 'google', 'migration')
                    DEFAULT 'manual'"
            );

            UserAccessPermission::where('source', 'shopify')->update(['source' => 'web']);

            DB::statement(
                "ALTER TABLE user_access_permissions
                    MODIFY COLUMN source ENUM('manual', 'web', 'access-code', 'challenges', 'apple', 'google', 'migration')
                    DEFAULT 'manual'"
            );
        }
    }


    public function down()
    {
        DB::statement(
            "ALTER TABLE user_access_permissions
                    MODIFY COLUMN source ENUM('manual', 'shopify', 'access-code', 'challenges', 'apple', 'google', 'migration')
                    DEFAULT 'manual'"
        );
    }
};
