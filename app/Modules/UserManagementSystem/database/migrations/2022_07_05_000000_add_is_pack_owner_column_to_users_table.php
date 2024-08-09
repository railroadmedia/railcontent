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
            $table->boolean('is_pack_owner')->after('singing_gear_photo')->default(false)->index();
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
            $table->dropColumn('is_pack_owner');
        });
    }

};
