<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::truncate();

        Setting::create([
            // SEO & Başlık
            'title'             => 'Aybars.dev | Backend Developer Portfolio',
            'meta_keywords'     => 'laravel, php, backend developer, clean code, software architecture, portfolio, aybars',
            'meta_description'  => 'Backend mimarisi, Clean Code prensipleri ve modern teknolojiler üzerine geliştirdiğim açık kaynak projeler ve teknik notlar.',
            'meta_author'       => 'Aybars Hasan Şalvarcı',

            // Logolar
            'logo_light'       => 'front/img/logo-header.png',
            'logo_dark'       => 'front/img/logo-footer.png',

            // Favicon Seti
            'favicon'           => 'front/img/favicon/favicon.ico',
            'favicon32x32'      => 'front/img/favicon/favicon-32x32.png',
            'favicon16x16'      => 'front/img/favicon/favicon-16x16.png',
            'apple_touch_icon'  => 'front/img/favicon/apple-touch-icon.png',
            'manifest'          => 'front/img/favicon/site.webmanifest',
            'mask_icon'         => 'front/img/favicon/safari-pinned-tab.svg',
            'browser_config'    => 'front/img/favicon/browserconfig.xml',

            // Sosyal Medya
            'github'            => 'https://github.com/aybarsdev',
            'twitter'           => 'https://twitter.com/aybarsdev',
            'linkedin'          => 'https://linkedin.com/in/aybarsdev',
            'instagram'         => 'https://instagram.com/aybarsdev',
            'email'             => 'contact@aybars.dev',

            // İletişim
            'address'           => 'İstanbul, Türkiye',
            'working_hours'     => 'Hafta İçi: 09:00 - 18:00',

            // Footer
            'footer_description'=> 'Yazılım geliştirme tutkusuyla modern ve ölçeklenebilir backend çözümleri üretiyorum. Kodun şiirsel yanını keşfetmeye devam.',
            'footer_text'       => '© ' . date('Y') . ' Aybars.dev. Tüm hakları saklıdır.',
        ]);
    }
}
