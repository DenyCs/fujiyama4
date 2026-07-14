<?php

namespace Modules\Menu\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Menu\Models\Category;
use Modules\Menu\Models\Menu;

class MenuDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Categories
        $ramen = Category::create(['name' => 'Ramen', 'slug' => 'ramen', 'order' => 1]);
        $topping = Category::create(['name' => 'Topping Tambahan', 'slug' => 'topping-tambahan', 'order' => 2]);
        $drink = Category::create(['name' => 'Minuman', 'slug' => 'minuman', 'order' => 3]);

        // Ramen menus
        Menu::create([
            'category_id' => $ramen->id,
            'name' => 'Tonkotsu Ramen',
            'slug' => 'tonkotsu-ramen',
            'description' => 'Ramen dengan kuah kaldu tulang babi yang kental dan gurih, disajikan dengan chashu, telur, dan nori.',
            'price' => 45000,
            'is_available' => true,
        ]);

        Menu::create([
            'category_id' => $ramen->id,
            'name' => 'Miso Ramen',
            'slug' => 'miso-ramen',
            'description' => 'Ramen dengan kuah miso fermentasi khas Jepang, topping ayam dan sayuran segar.',
            'price' => 42000,
            'is_available' => true,
        ]);

        Menu::create([
            'category_id' => $ramen->id,
            'name' => 'Shoyu Ramen',
            'slug' => 'shoyu-ramen',
            'description' => 'Ramen kuah kecap asin Jepang yang ringan namun kaya rasa, dengan daging panggang.',
            'price' => 40000,
            'is_available' => true,
        ]);

        Menu::create([
            'category_id' => $ramen->id,
            'name' => 'Kara Miso Ramen',
            'slug' => 'kara-miso-ramen',
            'description' => 'Ramen miso pedas dengan level kepedasan yang bisa disesuaikan, paket lengkap dengan telur dan nori.',
            'price' => 48000,
            'is_available' => true,
        ]);

        // Drinks
        Menu::create([
            'category_id' => $drink->id,
            'name' => 'Ocha (Teh Hijau)',
            'slug' => 'ocha-teh-hijau',
            'description' => 'Teh hijau Jepang asli, panas atau dingin.',
            'price' => 8000,
            'is_available' => true,
        ]);

        Menu::create([
            'category_id' => $drink->id,
            'name' => 'Calpico',
            'slug' => 'calpico',
            'description' => 'Minuman susu fermentasi Jepang yang menyegarkan.',
            'price' => 12000,
            'is_available' => true,
        ]);

        Menu::create([
            'category_id' => $drink->id,
            'name' => 'Matcha Latte',
            'slug' => 'matcha-latte',
            'description' => 'Latte dengan bubuk matcha premium dari Kyoto.',
            'price' => 15000,
            'is_available' => true,
        ]);

        // Toppings
        Menu::create([
            'category_id' => $topping->id,
            'name' => 'Extra Chashu',
            'slug' => 'extra-chashu',
            'description' => 'Tambah porsi daging chashu panggang.',
            'price' => 18000,
            'is_available' => true,
        ]);

        Menu::create([
            'category_id' => $topping->id,
            'name' => 'Telur Ajitsuke',
            'slug' => 'telur-ajitsuke',
            'description' => 'Telur rebus marinated khas Jepang.',
            'price' => 10000,
            'is_available' => true,
        ]);
    }
}