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
        //
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('sales_page_visible')->default(true);
            $table->timestamp('sales_page_start_date')->nullable();
            $table->timestamp('sales_page_end_date')->nullable();
            $table->timestamp('shop_card_start_date')->nullable();
            $table->timestamp('shop_card_end_date')->nullable();
            $table->renameColumn('visible', 'shop_card_visible');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('sales_page_visible');
            $table->dropColumn('sales_page_start_date');
            $table->dropColumn('sales_page_end_date');
            $table->dropColumn('shop_card_start_date');
            $table->dropColumn('shop_card_end_date');
            $table->renameColumn('shop_card_visible', 'visible');
        });
    }
};
