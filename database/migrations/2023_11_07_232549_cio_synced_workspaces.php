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
    public function up(): void
    {
        Schema::table('usora_users', function (Blueprint $table) {
            $table->dropColumn('cio_synced_workspaces');
        });

        Schema::table('usora_users', function (Blueprint $table) {
            $table->integer('cio_synced_workspaces')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {

    }
};
