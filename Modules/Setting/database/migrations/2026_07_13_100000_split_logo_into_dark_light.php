<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('restaurant_settings', function (Blueprint $table) {
            // Drop old single logo column
            $table->dropColumn('logo_image');

            // Add dark/light mode logo columns
            $table->string('logo_dark', 255)->nullable()->after('copyright_text');
            $table->string('logo_light', 255)->nullable()->after('logo_dark');
        });
    }

    public function down(): void
    {
        Schema::table('restaurant_settings', function (Blueprint $table) {
            $table->dropColumn(['logo_light', 'logo_dark']);

            // Restore old single logo column
            $table->string('logo_image', 255)->nullable()->after('copyright_text');
        });
    }
};