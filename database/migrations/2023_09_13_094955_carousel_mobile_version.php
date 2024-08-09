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
            $table->string('mobile_version')->nullable()->after('visible_on_mobile');
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
            $table->dropColumn('mobile_version');
        });
    }
};
