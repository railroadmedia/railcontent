<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_revisions', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->integer('revisionable_id');
            $table->string('revisionable_type');
            $table->integer('user_id');
            $table->longText('old_value')->nullable();
            $table->longText('new_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_revisions');
    }
};
