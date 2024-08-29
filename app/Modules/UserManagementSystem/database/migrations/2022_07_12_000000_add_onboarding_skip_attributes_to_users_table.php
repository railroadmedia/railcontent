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
        Schema::table('usora_users', function (Blueprint $table) {
            $table->boolean('singeo_onboarding_skip_setup')->after('drums_playing_since_year')->default(false);
            $table->boolean('guitareo_onboarding_skip_setup')->after('drums_playing_since_year')->default(false);
            $table->boolean('pianote_onboarding_skip_setup')->after('drums_playing_since_year')->default(false);
            $table->boolean('drumeo_onboarding_skip_setup')->after('drums_playing_since_year')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usora_users', function (Blueprint $table) {
            $table->dropColumn('drumeo_onboarding_skip_setup');
            $table->dropColumn('pianote_onboarding_skip_setup');
            $table->dropColumn('guitareo_onboarding_skip_setup');
            $table->dropColumn('singeo_onboarding_skip_setup');
        });
    }

};
