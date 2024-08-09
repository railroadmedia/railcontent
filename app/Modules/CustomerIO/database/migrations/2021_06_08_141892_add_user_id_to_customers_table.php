<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection(config('customer-io.database_connection_name'))
            ->table(
                'customer_io_customers',
                function (Blueprint $table) {
                    $table->integer('user_id')->nullable()->index()->after('email');
                }
            );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(config('customer-io.database_connection_name'))
            ->table(
                'customer_io_customers',
                function (Blueprint $table) {
                    $table->dropColumn('user_id');
                }
            );
    }
};
