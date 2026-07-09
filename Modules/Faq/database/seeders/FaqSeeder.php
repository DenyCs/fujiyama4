<?php

namespace Modules\Faq\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Faq\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Apa jam operasional Fujiyama Ramen?',
                'answer' => 'Fujiyama Ramen buka setiap hari Senin–Kamis pukul 10:00–21:00, Jumat pukul 13:00–22:00, dan Sabtu–Minggu pukul 10:00–22:00. Kami tetap melayani di hari libur nasional kecuali ada pemberitahuan khusus.',
                'order' => 1,
                'status' => 'active',
            ],
            [
                'question' => 'Metode pembayaran apa saja yang tersedia?',
                'answer' => 'Kami menerima pembayaran tunai, kartu debit/kredit (Visa, Mastercard), serta QRIS seperti GoPay, OVO, Dana, dan ShopeePay. Untuk pemesanan online, pembayaran bisa dilakukan di tempat saat mengambil pesanan.',
                'order' => 2,
                'status' => 'active',
            ],
            [
                'question' => 'Apakah bisa delivery atau diantar ke rumah?',
                'answer' => 'Saat ini Fujiyama Ramen tersedia di GoFood dan GrabFood untuk area sekitar. Anda juga bisa melakukan pre-order melalui website kami untuk diambil langsung di resto (takeaway). Kami sedang mempersiapkan layanan delivery sendiri — pantau terus informasinya!',
                'order' => 3,
                'status' => 'active',
            ],
            [
                'question' => 'Apakah perlu reservasi sebelum datang?',
                'answer' => 'Tidak wajib, tapi sangat disarankan terutama di akhir pekan dan jam makan siang/malam karena tempat kami cukup ramai. Anda bisa melakukan reservasi melalui halaman Reservasi di website ini atau menghubungi WhatsApp kami.',
                'order' => 4,
                'status' => 'active',
            ],
            [
                'question' => 'Apakah ada menu untuk yang tidak suka pedas?',
                'answer' => 'Tentu! Semua menu ramen kami bisa disesuaikan tingkat kepedasannya. Kami juga punya pilihan Shoyu Ramen dan Shio Ramen yang kuahnya gurih ringan tanpa pedas. Tanyakan pada staff kami saat memesan dan kami akan bantu rekomendasikan.',
                'order' => 5,
                'status' => 'active',
            ],
            [
                'question' => 'Bagaimana cara membatalkan reservasi?',
                'answer' => 'Anda bisa membatalkan reservasi dengan menghubungi WhatsApp kami di nomor yang tertera di halaman Kontak, maksimal 2 jam sebelum waktu reservasi. Pembatalan mendadak tetap kami terima, namun kami sangat menghargai pemberitahuan lebih awal agar kursi bisa diberikan ke pelanggan lain.',
                'order' => 6,
                'status' => 'active',
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}