<?php

namespace Modules\Event\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Event\Models\Event;

class EventDatabaseSeeder extends Seeder
{
    public function run()
    {
        Event::create([
            'title'          => 'Festival Ramen Musim Dingin',
            'description'    => 'Nikmati kehangatan ramen premium kami di musim hujan! Setiap pembelian 2 bowl ramen gratis 1 ocha.',
            'start_date'     => '2026-06-01',
            'end_date'       => '2026-06-15',
            'discount_promo' => 'Buy 2 Get 1 Ocha',
            'status'         => 'inactive',
        ]);

        Event::create([
            'title'          => 'Summer Ramen Fiesta',
            'description'    => 'Rayakan musim panas dengan diskon spesial 20% untuk semua menu ramen! Berlaku setiap Senin—Jumat pukul 11:00—15:00.',
            'start_date'     => '2026-07-01',
            'end_date'       => '2026-08-31',
            'discount_promo' => 'Diskon 20%',
            'status'         => 'active',
        ]);

        Event::create([
            'title'          => 'Kombo Hemat Keluarga',
            'description'    => 'Paket hemat untuk 4 orang: 4 bowl ramen pilihan + 4 minuman + 2 topping tambahan hanya Rp 200.000! Tersedia setiap akhir pekan.',
            'start_date'     => '2026-07-05',
            'end_date'       => '2026-09-30',
            'discount_promo' => 'Paket Keluarga Rp 200K',
            'status'         => 'active',
        ]);
    }
}