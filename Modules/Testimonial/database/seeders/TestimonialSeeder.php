<?php

namespace Modules\Testimonial\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Testimonial\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'customer_name' => 'Dewi Lestari',
                'customer_photo' => null,
                'rating' => 5,
                'review' => 'Ramen terenak yang pernah saya coba! Kuah tonkotsunya super creamy dan gurih banget. Porsinya juga besar, worth every penny. Pasti balik lagi!',
                'order_type' => 'Tonkotsu Ramen',
                'status' => 'active',
                'order' => 0,
            ],
            [
                'customer_name' => 'Rizky Pratama',
                'customer_photo' => null,
                'rating' => 5,
                'review' => 'Sebagai pecinta ramen sejati, Fujiyama Ramen benar-benar memenuhi ekspektasi. Mie-nya kenyal, chashu-nya tebal dan empuk, dan yang paling penting kuahnya otentik banget!',
                'order_type' => 'Spicy Miso Ramen',
                'status' => 'active',
                'order' => 1,
            ],
            [
                'customer_name' => 'Sari Dewanti',
                'customer_photo' => null,
                'rating' => 4,
                'review' => 'Pertama kalinya nyobain ramen disini langsung jatuh cinta! Tempatnya cozy, pelayanannya ramah, dan menu-nya variatif. Cocok buat dinner bareng temen atau keluarga.',
                'order_type' => 'Shoyu Ramen',
                'status' => 'active',
                'order' => 2,
            ],
            [
                'customer_name' => 'Bayu Anggara',
                'customer_photo' => null,
                'rating' => 5,
                'review' => 'Nggak nyangka di kota ini ada ramen se-enak ini. Bakal jadi langganan tetap nih! Apalagi harga student-nya bersahabat banget. Recommended!',
                'order_type' => 'Chicken Katsu Ramen',
                'status' => 'active',
                'order' => 3,
            ],
            [
                'customer_name' => 'Aulia Rahma',
                'customer_photo' => null,
                'rating' => 5,
                'review' => 'Gyoza dan ramen-nya juara! Tempatnya juga instagramable banget. Cocok buat yang suka foto-foto sambil makan enak. Bakal ajak temen-temen kesini lagi!',
                'order_type' => 'Black Garlic Ramen',
                'status' => 'active',
                'order' => 4,
            ],
        ];

        foreach ($testimonials as $data) {
            Testimonial::create($data);
        }
    }
}