<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('user_access_permissions', function (Blueprint $table) {
            $table->unique(['user_id', 'source', 'source_hash'], 'source_hash_unique');
        });
    }

    public function down(): void
    {
        Schema::table('user_access_permissions', function (Blueprint $table) {
            $table->dropUnique('source_hash_unique');
        });
    }
};
