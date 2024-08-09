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
        Schema::table('usora_remember_tokens', function (Blueprint $table) {
            $table->timestamp('updated_at')->after('created_at')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usora_remember_tokens', function (Blueprint $table) {
            $table->dropColumn('updated_at');
        });
    }
};
