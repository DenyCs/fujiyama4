<?php

namespace Modules\Banner\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Banner\Models\Banner;

class BannerDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'title'       => 'Authentic Ramen Experience',
                'subtitle'    => 'Menu Baru',
                'description' => 'Handcrafted noodles, 18-hour slow-cooked tonkotsu broth, and the freshest toppings — every bowl tells a story of tradition and passion.',
                'image'       => 'placeholder-01.jpg',
                'cta_text'    => 'Lihat Menu',
                'cta_link'    => '/menu',
                'order'       => 1,
                'status'      => 'active',
            ],
            [
                'title'       => 'Spicy Miso Ramen',
                'subtitle'    => 'Promo',
                'description' => 'Nikmati kelezatan Spicy Miso Ramen dengan diskon 20% setiap Senin—Jumat jam 14.00—17.00. Pedas, gurih, dan menggugah selera!',
                'image'       => 'placeholder-02.jpg',
                'cta_text'    => 'Pesan Sekarang',
                'cta_link'    => '/menu',
                'order'       => 2,
                'status'      => 'active',
            ],
            [
                'title'       => 'Weekend Special Set',
                'subtitle'    => 'Hemat',
                'description' => 'Paket hemat akhir pekan: 2 mangkuk ramen pilihan + 2 minuman spesial hanya Rp 85.000. Tersedia setiap Sabtu & Minggu.',
                'image'       => 'placeholder-03.jpg',
                'cta_text'    => 'Lihat Promo',
                'cta_link'    => '/menu',
                'order'       => 3,
                'status'      => 'active',
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}