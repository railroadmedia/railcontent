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
        Schema::table('carousels', function (Blueprint $table) {
            $table->boolean('visible_on_desktop')->default(true);
            $table->boolean('visible_on_mobile')->default(true);
        });

        \App\Models\Carousel::query()->where('visible',0)->update([
            'visible_on_desktop' => false,
            'visible_on_mobile' => false,
        ]);
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
            $table->dropColumn('visible_on_desktop');
            $table->dropColumn('visible_on_mobile');
        });
    }
};
