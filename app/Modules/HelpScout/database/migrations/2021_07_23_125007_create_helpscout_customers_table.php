<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(
            'helpscout_customers',
            function (Blueprint $table) {

                $table->increments('internal_id');

                $table->bigInteger('external_id')->index();

                $table->timestamp('created_at')->index();
                $table->timestamp('updated_at')->index();
                $table->softDeletes();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('helpscout_customers');
    }
};
