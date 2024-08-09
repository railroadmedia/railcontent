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
        Schema::table('carousels', function (Blueprint $table) {
            $table->dropColumn('mobile_version');
            $table->string('mobile_version_above')->nullable()->after('visible_on_mobile');
            $table->string('mobile_version_below')->nullable()->after('mobile_version_above');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('carousels', function (Blueprint $table) {
            $table->dropColumn('mobile_version_above');
            $table->dropColumn('mobile_version_below');
            $table->string('mobile_version')->nullable()->after('visible_on_mobile');
        });
    }
};
