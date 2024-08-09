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
        //
        Schema::table('cohorts', function (Blueprint $table) {
            $table->string('first_day_text')
                ->nullable();
            $table->string('last_day_text')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        //
        Schema::table('cohorts', function (Blueprint $table) {
            $table->dropColumn('first_day_text');
            $table->dropColumn('last_day_text');
        });
    }
};
