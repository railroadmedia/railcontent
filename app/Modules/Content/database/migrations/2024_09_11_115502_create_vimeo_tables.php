<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vimeo', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('external_id')->index();
            $table->json('video_playback_endpoints')->nullable();
            $table->string('video_poster_image_url')->nullable();
            $table->string('hlsManifestUrl')->nullable();
            $table->integer('length_in_seconds')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vimeo');
    }
};
