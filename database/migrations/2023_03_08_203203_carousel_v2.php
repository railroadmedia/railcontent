<?php

use App\Models\Carousel;
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
        Schema::table('carousels', function (Blueprint $table) {
            $table->renameColumn('cta_text', 'primary_cta_text');
            $table->renameColumn('cta_url', 'primary_cta_url');
            $table->renameColumn('img', 'desktop_img');
            $table->renameColumn('product_url', 'primary_cta_url_alt');
            $table->string('primary_cta_text_alt')->nullable();
            $table->string('secondary_cta_text')->nullable();
            $table->string('secondary_cta_url')->nullable();
            $table->string('tablet_img');
            $table->string('mobile_img');
            $table->string('desc_color')->nullable();
            $table->dropColumn('endpoint');
            $table->string('name');
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
        Schema::table('carousels', function (Blueprint $table) {
            $table->renameColumn('primary_cta_text', 'cta_text');
            $table->renameColumn('primary_cta_url', 'cta_url');
            $table->renameColumn('desktop_img', 'img');
            $table->renameColumn('primary_cta_url_alt', 'product_url');
            $table->dropColumn('primary_cta_text_alt');
            $table->dropColumn('secondary_cta_text');
            $table->dropColumn('secondary_cta_url');
            $table->dropColumn('tablet_img');
            $table->dropColumn('mobile_img');
            $table->dropColumn('desc_color');
            $table->string('endpoint');
            $table->dropColumn('name');
        });
    }
};
