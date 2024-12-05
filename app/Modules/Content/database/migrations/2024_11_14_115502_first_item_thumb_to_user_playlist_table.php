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
        Schema::table('railcontent_user_playlists', function (Blueprint $table) {
            $table->string('first_item_thumbnail_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('railcontent_user_playlists', function (Blueprint $table) {
            $table->dropColumn('first_item_thumbnail_url');
        });
    }
};
