<?php

namespace Modules\About\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\About\Models\GalleryCategory;

class GalleryCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Interior', 'Proses Masak', 'Suasana', 'Lainnya'];

        foreach ($categories as $name) {
            GalleryCategory::firstOrCreate(['name' => $name]);
        }
    }
}