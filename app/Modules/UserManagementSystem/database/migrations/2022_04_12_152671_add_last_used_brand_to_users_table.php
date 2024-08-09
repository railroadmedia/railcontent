<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('usora_users', function (Blueprint $table) {
            $table->string('last_used_brand')->after('permission_level')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('usora_users', function (Blueprint $table) {
            $table->dropColumn('last_used_brand');
        });
    }
};
