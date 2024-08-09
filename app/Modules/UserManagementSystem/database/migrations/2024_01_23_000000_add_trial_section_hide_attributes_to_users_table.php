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
    public function up()
    {
        Schema::table('usora_users', function (Blueprint $table) {
            $table->boolean('singeo_trial_section_hide')->after('singeo_onboarding_skip_setup')->default(false);
            $table->boolean('guitareo_trial_section_hide')->after('singeo_onboarding_skip_setup')->default(false);
            $table->boolean('pianote_trial_section_hide')->after('singeo_onboarding_skip_setup')->default(false);
            $table->boolean('drumeo_trial_section_hide')->after('singeo_onboarding_skip_setup')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usora_users', function (Blueprint $table) {
            $table->dropColumn('drumeo_trial_section_hide');
            $table->dropColumn('pianote_trial_section_hide');
            $table->dropColumn('guitareo_trial_section_hide');
            $table->dropColumn('singeo_trial_section_hide');
        });
    }

};
