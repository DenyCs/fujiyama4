<?php

namespace Modules\SectionContent\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SectionContent\Models\SectionContent;

class SectionContentSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            [
                'section_key' => 'menu_unggulan',
                'badge_text' => "Chef's Selection",
                'title' => 'Menu Unggulan',
                'subtitle' => 'Pilihan terbaik dari dapur kami, dibuat dengan bahan segar dan penuh cita rasa.',
            ],
            [
                'section_key' => 'tentang_kami',
                'badge_text' => 'Tentang Fujiyama Ramen',
                'title' => 'Cerita Kami',
                'subtitle' => 'Dari hati untuk setiap mangkuk yang tersaji.',
            ],
            [
                'section_key' => 'galeri_foto',
                'badge_text' => '📸 Momen di Fujiyama',
                'title' => 'Galeri Foto',
                'subtitle' => 'Intip keseruan di balik layar dan suasana hangat di Fujiyama Ramen.',
            ],
            [
                'section_key' => 'lokasi_jam_buka',
                'badge_text' => 'Kunjungi Kami',
                'title' => 'Lokasi & Jam Buka',
                'subtitle' => null,
            ],
            [
                'section_key' => 'testimoni',
                'badge_text' => null,
                'title' => 'Apa Kata *Pelanggan* Kami',
                'subtitle' => 'Setiap mangkuk punya cerita. Simak pengalaman para pelanggan setia kami.',
            ],
            [
                'section_key' => 'event_promo',
                'badge_text' => 'Event & Promo',
                'title' => 'Jangan Lewatkan Keseruannya!',
                'subtitle' => 'Ikuti event spesial dan promo menarik dari Fujiyama Ramen.',
            ],
            [
                'section_key' => 'faq',
                'badge_text' => 'Pertanyaan yang Sering Diajukan',
                'title' => 'FAQ',
                'subtitle' => 'Semua yang perlu kamu tahu tentang Fujiyama Ramen.',
            ],
        ];

        foreach ($sections as $section) {
            SectionContent::firstOrCreate(
                ['section_key' => $section['section_key']],
                $section
            );
        }

        $this->command->info('SectionContent seeder: 7 sections seeded.');
    }
}