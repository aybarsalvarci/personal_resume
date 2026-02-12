<?php

namespace Database\Seeders;

use App\Models\HomePage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomePage::truncate();
        HomePage::create([
            'hero_badge' => 'Computer Engineering Student',
            'hero_title' => 'Kodla<br> <span class="gradient-text">Sistemler</span><br>  İnşa Et.',
            'hero_subtitle' => 'Bilgisayar Mühendisliği Öğrencisi & Backend Developer',
            'hero_description' => 'Öğrenmeye ve gelişmeye açık bir bilgisayar mühendisliği öğrencisi olarak, sürdürülebilir ve ölçeklenebilir backend sistemler geliştirmeye odaklanıyorum. Her proje ile clean architecture ve best practices öğrenmeye devam ediyorum.',

            'hero_terminal' => [
                'whoami' => 'Aybars Şalvarcı - Bilgisayar Mühendisliği Öğrencisi',
                'cat ./focus.txt' => '"Her gün biraz daha iyi kod yazmayı öğreniyorum"',
                'echo $STATUS' => 'Öğreniyor, geliştiriyor, büyüyor 🚀'
            ],

            'stats' => [
                'Projeler' => '15+',
                'Teknolojiler' => '8+',
                'Deneyim' => '2Y',
                'Motivasyon' => '∞'
            ],

            'about' => [
                'subtitle' => 'Backend sistemler ve temiz kod mimarisi...',
                'left' => [
                    'description' => 'left-description',
                    'tags' => 'code,practise'
                ],
                'right' => [
                    'description' => 'right-description',
                    'list' => ['tst', 'deneme']
                ]
            ],

            'techs' => [
                [
                    'icon' => 'fas fa-server',
                    'title' => 'Backend Development',
                    'description' => 'RESTful API\'ler, authentication sistemleri ve database tasarımı',
                    'tags' => 'Laravel, dotnet core, Spring, REST API'
                ],
                [
                    'icon' => 'fas fa-database',
                    'title' => 'Database Systems',
                    'description' => 'İlişkisel veritabanı sistemleri ve query optimizasyonu.',
                    'tags' => 'MySql, PostgreSql, MSSql, Optimization'
                ],
                [
                    'icon' => 'fas fa-tools',
                    'title' => 'DevOPS & Tools',
                    'description' => 'Containerization ve modern development tooling',
                    'tags' => 'Docker, GIT, Linux, CI/CD'
                ]
            ],

            'principles' => [
                "Okunabilirlik, kısalıktan daha önemlidir",
                "Test yazılmayan kod teknik borçtur",
                "Yorum yerine iyi isimlendirme tercih ederim",
                "Sistemler zamanla evrilmelidir, sert olmamalıdır",
                "Erken optimizasyon tüm kötülüklerin anasıdır"
            ],

            'setup' => [
                'os' => 'Windows/Linux',
                'editor' => 'VsCode',
                'terminal' => 'Bash',
                'db' => 'Navicat',
                'containerization' => "Docker"
            ]
        ]);
    }
}

