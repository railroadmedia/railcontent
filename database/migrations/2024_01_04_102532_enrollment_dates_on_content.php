<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('railcontent_content', function (Blueprint $table) {
            $table->dateTime('enrollment_start_time')->nullable()->after('like_count')->index();
            $table->dateTime('enrollment_end_time')->nullable()->after('enrollment_start_time')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('railcontent_content', function (Blueprint $table) {
            $table->dropColumn('enrollment_start_time');
            $table->dropColumn('enrollment_end_time');
        });
    }
};
