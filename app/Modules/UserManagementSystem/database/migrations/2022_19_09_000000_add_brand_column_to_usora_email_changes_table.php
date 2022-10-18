<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBrandColumnToUsoraEmailChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usora_email_changes', function (Blueprint $table) {
            $table->string('brand')->after('token')->default("drumeo");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usora_email_changes', function (Blueprint $table) {
            $table->dropColumn('brand');
        });
    }

}
