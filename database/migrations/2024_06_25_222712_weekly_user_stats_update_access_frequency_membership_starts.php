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
        Schema::table('weekly_user_statistics', function (Blueprint $table) {
            $table->dropColumn('access_frequency');
        });

        Schema::table('weekly_user_statistics', function (Blueprint $table) {
            $table->enum('access_frequency', [
                '1 month',
                '2 month',
                '3 month',
                '6 month',
                '5 year',
                '1 year',
                'lifetime',
                'other',
                'trial'
            ])
                ->default('other')
                ->after('access_type')
                ->index();

            $table->boolean('started')->after('expired')->index()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('weekly_user_statistics', function (Blueprint $table) {
            $table->dropColumn('access_frequency');
        });

        Schema::table('weekly_user_statistics', function (Blueprint $table) {
            $table->enum('access_frequency', ['monthly', 'yearly', 'lifetime', 'other', 'trial'])
                ->default('other')
                ->after('access_type')
                ->index();

            $table->dropColumn('started');
        });
    }
};
