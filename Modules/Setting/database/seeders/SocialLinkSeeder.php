<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Setting\Models\SocialLink;

class SocialLinkSeeder extends Seeder
{
    public function run(): void
    {
        SocialLink::create([
            'platform' => 'Instagram',
            'url'      => 'https://www.instagram.com/fujiyamaramen/',
            'order'    => 1,
            'status'   => 'active',
        ]);

        SocialLink::create([
            'platform' => 'Facebook',
            'url'      => 'https://www.facebook.com/fujiyamaramen/',
            'order'    => 2,
            'status'   => 'active',
        ]);

        SocialLink::create([
            'platform' => 'WhatsApp',
            'url'      => 'https://wa.me/6281234567890',
            'order'    => 3,
            'status'   => 'active',
        ]);
    }
}