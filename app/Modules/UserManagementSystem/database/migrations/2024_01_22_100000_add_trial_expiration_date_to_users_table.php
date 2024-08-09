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
            $table->dateTime('trial_expiration_date')->nullable()->index();
            $table->boolean('is_trial')
                ->default(false);
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
            $table->dropColumn('trial_expiration_date');
            $table->dropColumn('is_trial');
        });
    }

};
