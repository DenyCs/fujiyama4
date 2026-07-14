<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambah kolom gallery_category_id (nullable dulu)
        Schema::table('about_gallery', function (Blueprint $table) {
            $table->foreignId('gallery_category_id')->nullable()->after('id');
        });

        // 2. Migrasi data: map enum value ke gallery_categories.name
        $map = [
            'interior'     => 'Interior',
            'proses_masak' => 'Proses Masak',
            'suasana'      => 'Suasana',
            'lainnya'      => 'Lainnya',
        ];

        foreach ($map as $enum => $name) {
            $catId = DB::table('gallery_categories')->where('name', $name)->value('id');
            if ($catId) {
                DB::table('about_gallery')->where('category', $enum)->update(['gallery_category_id' => $catId]);
            }
        }

        // 3. Hapus kolom category lama
        Schema::table('about_gallery', function (Blueprint $table) {
            $table->dropColumn('category');
        });

        // 4. Jadikan NOT NULL + FK constraint
        Schema::table('about_gallery', function (Blueprint $table) {
            $table->foreignId('gallery_category_id')->nullable(false)->change();
            $table->foreign('gallery_category_id')->references('id')->on('gallery_categories')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::table('about_gallery', function (Blueprint $table) {
            $table->dropForeign(['gallery_category_id']);
            $table->dropColumn('gallery_category_id');
            $table->enum('category', ['interior', 'proses_masak', 'suasana', 'lainnya'])->nullable()->after('id');
        });
    }
};