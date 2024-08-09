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
        Schema::table('railcontent_permissions', function (Blueprint $table) {
            $table->dropColumn('shopify_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('railcontent_permissions', function (Blueprint $table) {
            // we store our permissions in Shopify as metaobjects, which have a string guid instead of the usual integer
            $table->string('shopify_id')->nullable();
        });
    }
};
