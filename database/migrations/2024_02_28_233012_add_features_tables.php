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
        Schema::create('features_features', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('allow_filter')->nullable();
            $table->text('userid_list')->nullable();
            $table->timestamp('active_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('features_experiments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('default_value')->nullable();
            $table->boolean('enabled')->default(true);
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('features_branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('content');
            $table->unsignedBigInteger('experiment_id');
            $table->foreign('experiment_id')->references('id')->on('features_experiments');
            $table->integer('priority')->nullable();
            $table->string('allow_filter')->nullable();
            $table->text('userid_list')->nullable();
            $table->integer('weight')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('features_tracking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('experiment_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('features_branches');
            $table->foreign('user_id')->references('id')->on('usora_users');
            $table->foreign('experiment_id')->references('id')->on('features_experiments');
            $table->string('anonymous_user_id')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('features_features');
        Schema::dropIfExists('features_tracking');
        Schema::dropIfExists('features_branches');
        Schema::dropIfExists('features_experiments');

    }
};
