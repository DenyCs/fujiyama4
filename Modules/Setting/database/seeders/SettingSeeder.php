<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Setting\Models\RestaurantSetting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $setting = RestaurantSetting::getContent();

        if (!$setting->address) {
            $setting->update([
                'address' => 'Jl. Merdeka No. 123, Kelurahan Sukamaju, Kecamatan Cibinong, Kabupaten Bogor, Jawa Barat 16912',
                'phone' => '(021) 1234-5678',
                'google_maps_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.123456789!2d106.123456!3d-6.123456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM8KwMjcnMjQuNCJTIDEwNsKwMjcnMjQuNCJF!5e0!3m2!1sen!2sid!4v1234567890',
                'opening_hours' => json_encode([
                    'senin' => '11:00 - 21:00',
                    'selasa' => '11:00 - 21:00',
                    'rabu' => '11:00 - 21:00',
                    'kamis' => '11:00 - 21:00',
                    'jumat' => '11:00 - 21:30',
                    'sabtu' => '10:00 - 22:00',
                    'minggu' => '10:00 - 22:00',
                ]),
            ]);
        }

        // Ensure footer fields have defaults if null
        if (!$setting->footer_description) {
            $setting->update([
                'footer_description' => 'Authentic Japanese ramen experience. Handcrafted noodles, rich broth, and premium toppings — crafted with passion since 2015.',
            ]);
        }
        if (!$setting->copyright_text) {
            $setting->update([
                'copyright_text' => 'Fujiyama Ramen. All rights reserved.',
            ]);
        }
    }
}