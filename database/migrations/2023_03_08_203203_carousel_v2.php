<?php

use App\Models\Carousel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // SQLite has some unique needs
        if (Schema::getConnection()->getDriverName() === "sqlite") {
            $this->upSqlite();
        } else {
            Schema::table('carousels', function (Blueprint $table) {
                $table->renameColumn('cta_text', 'primary_cta_text');
                $table->renameColumn('cta_url', 'primary_cta_url');
                $table->renameColumn('img', 'desktop_img');
                $table->renameColumn('product_url', 'primary_cta_url_alt');
                $table->string('primary_cta_text_alt')->nullable();
                $table->string('secondary_cta_text')->nullable();
                $table->string('secondary_cta_url')->nullable();
                $table->string('tablet_img');
                $table->string('mobile_img');
                $table->string('desc_color')->nullable();
                $table->dropColumn('endpoint');
                $table->string('name');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::getConnection()->getDriverName() === "sqlite") {
            $this->downSqlite();
        } else {
            Schema::table('carousels', function (Blueprint $table) {
                $table->renameColumn('primary_cta_text', 'cta_text');
                $table->renameColumn('primary_cta_url', 'cta_url');
                $table->renameColumn('desktop_img', 'img');
                $table->renameColumn('primary_cta_url_alt', 'product_url');
                $table->dropColumn('primary_cta_text_alt');
                $table->dropColumn('secondary_cta_text');
                $table->dropColumn('secondary_cta_url');
                $table->dropColumn('tablet_img');
                $table->dropColumn('mobile_img');
                $table->dropColumn('desc_color');
                $table->string('endpoint');
                $table->dropColumn('name');
            });
        }
    }

    /**
     * Run the migrations (separated out for SQLite support)
     *
     * @return void
     */
    private function upSqlite(): void
    {
        // SQLite doesn't support multiple calls to dropColumn / renameColumn in a single modification
        Schema::table('carousels', function (Blueprint $table) {
            $table->renameColumn('cta_text', 'primary_cta_text');
        });
        Schema::table('carousels', function (Blueprint $table) {
            $table->renameColumn('cta_url', 'primary_cta_url');
        });
        Schema::table('carousels', function (Blueprint $table) {
            $table->renameColumn('img', 'desktop_img');
        });
        Schema::table('carousels', function (Blueprint $table) {
            $table->renameColumn('product_url', 'primary_cta_url_alt');
        });
        Schema::table('carousels', function (Blueprint $table) {
            $table->string('primary_cta_text_alt')->nullable();
            $table->string('secondary_cta_text')->nullable();
            $table->string('secondary_cta_url')->nullable();
            $table->dropColumn('endpoint');
        });
        // SQLite won't allow you to add a not null column without a default value, to an
        // existing table, so make it nullable and remove that after, as a workaround hack
        Schema::table('carousels', function (Blueprint $table) {
            $table->string('tablet_img')->nullable();
            $table->string('mobile_img')->nullable();
            $table->string('desc_color')->nullable();
            $table->string('name')->nullable();
        });
        Schema::table('carousels', function (Blueprint $table) {
            $table->string('tablet_img')->nullable(false)->change();
            $table->string('mobile_img')->nullable(false)->change();
            $table->string('name')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations (separated out for SQLite support)
     *
     * @return void
     */
    public function downSqlite(): void
    {
        Schema::table('carousels', function (Blueprint $table) {
            $table->renameColumn('primary_cta_text', 'cta_text');
        });
        Schema::table('carousels', function (Blueprint $table) {
            $table->renameColumn('primary_cta_url', 'cta_url');
        });
        Schema::table('carousels', function (Blueprint $table) {
            $table->renameColumn('desktop_img', 'img');
        });
        Schema::table('carousels', function (Blueprint $table) {
            $table->renameColumn('primary_cta_url_alt', 'product_url');
        });
        Schema::table('carousels', function (Blueprint $table) {
            $table->dropColumn('primary_cta_text_alt');
        });
        Schema::table('carousels', function (Blueprint $table) {
            $table->dropColumn('secondary_cta_text');
        });
        Schema::table('carousels', function (Blueprint $table) {
            $table->dropColumn('secondary_cta_url');
        });
        Schema::table('carousels', function (Blueprint $table) {
            $table->dropColumn('tablet_img');
        });
        Schema::table('carousels', function (Blueprint $table) {
            $table->dropColumn('mobile_img');
        });
        Schema::table('carousels', function (Blueprint $table) {
            $table->dropColumn('desc_color');
        });
        Schema::table('carousels', function (Blueprint $table) {
            $table->string('endpoint');
            $table->dropColumn('name');
        });
    }
};
