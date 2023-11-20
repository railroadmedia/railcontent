<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        DB::statement(
            "ALTER TABLE user_access_permissions
                    MODIFY COLUMN source ENUM('manual', 'shopify', 'access-code', 'challenges', 'revenue-cat')
                    DEFAULT 'manual'"
        );
    }

    public function down()
    {
        //
    }
};
