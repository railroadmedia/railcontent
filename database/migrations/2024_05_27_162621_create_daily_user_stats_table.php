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
        Schema::create('daily_user_statistics', function (Blueprint $table) {
            $table->id();
            $table->date('day')->index();
            $table->enum('brand_allocation_type', ['by_last_used_brand', 'by_most_content_starts', 'by_percentage_of_content_starts'])->index();
            $table->enum('brand', ['drumeo','pianote','guitareo','singeo','musora'])->index();
            $table->integer('total_members_with_full_access')->index();
            $table->integer('total_members_with_basic_access')->index();
            $table->integer('total_lifetime_members')->index();
            $table->integer('total_active_members')->index();
            $table->integer('total_expired_members')->index();
            $table->dateTime('generated_at')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_user_statistics');
    }
};
