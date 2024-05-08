<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_io_customers', function (Blueprint $table) {
            $table->dropUnique('customer_io_customers_uuid_unique');
            $table->unique(['workspace_id', 'uuid'], 'customer_io_customers_uuid_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_io_customers', function (Blueprint $table) {
            $table->dropUnique('customer_io_customers_uuid_unique');
            $table->unique('uuid', 'customer_io_customers_uuid_unique');
        });
    }
};
