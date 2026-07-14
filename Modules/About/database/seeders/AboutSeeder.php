<?php

namespace Modules\About\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\About\Models\AboutUs;
use Modules\About\Models\AboutGallery;
use Modules\About\Models\GalleryCategory;

class AboutSeeder extends Seeder
{
    /**
     * Seed the about_us and about_gallery tables.
     */
    public function run(): void
    {
        // 1 record AboutUs — firstOrCreate ensures idempotency
        $about = AboutUs::firstOrCreate(
            ['id' => 1],
            [
                'title'    => 'Tentang Kami',
                'subtitle' => 'Filosofi di Balik Setiap Mangkuk',
                'story'    => "Fujiyama Ramen lahir dari kecintaan mendalam terhadap kuliner Jepang dan filosofi bahwa setiap mangkuk ramen adalah sebuah karya seni.\n\n"
                    . "Didirikan pada tahun 2022 di jantung kota, kami menghadirkan cita rasa autentik Negeri Sakura dengan sentuhan lokal yang hangat. "
                    . "Setiap bahan dipilih dengan teliti — dari tulang babi pilihan untuk tonkotsu broth yang direbus selama 18 jam, "
                    . "hingga mie buatan tangan yang kenyal dan sempurna menyerap kuah.\n\n"
                    . "Filosofi kami sederhana: 'Isshoku Kenmei' — mengerahkan segenap hati dan jiwa ke dalam satu hal. "
                    . "Bagi kami, ramen bukan sekadar makanan cepat saji; ia adalah ritual, pengalaman, dan cerita yang tersaji dalam semangkuk kehangatan.\n\n"
                    . "Di dapur Fujiyama, kami terus bereksperimen dengan rasa tanpa meninggalkan akar tradisi. "
                    . "Kombinasi rempah lokal Indonesia dengan teknik memasak Jepang menciptakan harmoni rasa yang unik dan tak terlupakan.\n\n"
                    . "Selamat datang di keluarga Fujiyama Ramen. Nikmati setiap seruputnya, dan biarkan cerita kami menemani santap Anda.",
            ]
        );

        // Placeholder gallery entries with categories
        $galleryItems = [
            [
                'image'    => 'placeholder-interior-1.jpg',
                'category' => 'interior',
                'caption'  => 'Ruang Makan Utama',
                'order'    => 1,
            ],
            [
                'image'    => 'placeholder-dapur-1.jpg',
                'category' => 'proses_masak',
                'caption'  => 'Dapur Utama — Tempat Keajaiban Tercipta',
                'order'    => 1,
            ],
            [
                'image'    => 'placeholder-interior-2.jpg',
                'category' => 'interior',
                'caption'  => 'Suasana Malam yang Hangat',
                'order'    => 2,
            ],
            [
                'image'    => 'placeholder-proses-2.jpg',
                'category' => 'proses_masak',
                'caption'  => 'Chef Meracik Mangkuk Spesial',
                'order'    => 2,
            ],
            [
                'image'    => 'placeholder-suasana-1.jpg',
                'category' => 'suasana',
                'caption'  => 'Pelanggan Menikmati Ramen',
                'order'    => 1,
            ],
            [
                'image'    => 'placeholder-suasana-2.jpg',
                'category' => 'suasana',
                'caption'  => 'Live Music Malam Minggu',
                'order'    => 2,
            ],
        ];

        // Map old enum values to GalleryCategory names
        $categoryMap = [
            'interior'     => 'Interior',
            'proses_masak' => 'Proses Masak',
            'suasana'      => 'Suasana',
            'lainnya'      => 'Lainnya',
        ];

        foreach ($galleryItems as $item) {
            $categoryName = $categoryMap[$item['category']] ?? 'Lainnya';
            $galleryCategory = GalleryCategory::where('name', $categoryName)->first();

            if ($galleryCategory) {
                AboutGallery::firstOrCreate(
                    ['image' => $item['image']],
                    [
                        'caption'            => $item['caption'],
                        'gallery_category_id' => $galleryCategory->id,
                        'order'              => $item['order'],
                    ]
                );
            }
        }
    }
}