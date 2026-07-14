<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->foreignId('primary_photo_id')
                ->nullable()
                ->after('story')
                ->constrained('about_gallery')
                ->nullOnDelete();

            $table->foreignId('secondary_photo_id')
                ->nullable()
                ->after('primary_photo_id')
                ->constrained('about_gallery')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->dropConstrainedForeignId('primary_photo_id');
            $table->dropConstrainedForeignId('secondary_photo_id');
        });
    }
};