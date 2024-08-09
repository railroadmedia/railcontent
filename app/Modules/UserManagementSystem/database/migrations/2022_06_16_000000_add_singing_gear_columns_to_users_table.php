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
        Schema::table('usora_users', function (Blueprint $table) {
            $table->string('singing_since_year')->nullable()->index();
            $table->string('singing_gear_mic_brands')->nullable()->index();
            $table->string('singing_gear_photo')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usora_users', function (Blueprint $table) {
            $table->dropColumn('singing_since_year');
            $table->dropColumn('singing_gear_mic_brands');
            $table->dropColumn('singing_gear_photo');

        });
    }

};
