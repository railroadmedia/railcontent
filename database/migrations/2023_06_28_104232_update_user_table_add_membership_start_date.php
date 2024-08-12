<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('usora_users', function (Blueprint $table) {
            $table->timestamp('membership_start_date')->after('membership_level')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('usora_users', function (Blueprint $table) {
            $table->dropColumn('membership_start_date');
        });
    }
};
