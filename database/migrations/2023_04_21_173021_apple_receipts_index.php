<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('ecommerce_apple_receipts', function (Blueprint $table) {
            $table->index(['updated_at']);
        });
    }

    public function down(): void
    {
        Schema::table('ecommerce_apple_receipts', function (Blueprint $table) {
            $table->dropindex(['updated_at']);
        });
    }
};
