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
            'hero_terminal' => '{"whoami":"Aybars \\u015ealvarc\\u0131 - Bilgisayar M\\u00fchendisli\\u011fi \\u00d6\\u011frencisi","cat .\\/focus.txt":"\\"Her g\\u00fcn biraz daha iyi kod yazmay\\u0131 \\u00f6\\u011freniyorum\\"","echo $STATUS":"\\u00d6\\u011freniyor, geli\\u015ftiriyor, b\\u00fcy\\u00fcyor \\ud83d\\ude80"}',
            'stats' => '{"Projeler":"15+","Teknolojiler":"8+","Deneyim":"2Y","Motivasyon":"\\u221e"}',
            'about' => '{"subtitle":"Backend sistemler ve temiz kod mimarisi...", "left":{"description":"left-description","tags":"code,practise"},"right":{"description":"right-description","list":["tst", "deneme"]}}',
            'techs' => '[{"icon":"fas fa-server","title":"Backend Development","description":"RESTful API\'ler, authentication sistemleri ve database tasar\\u0131m\\u0131","tags":"Laravel, dotnet core, Spring, REST API"},{"icon":"fas fa-database","title":"Database Systems","description":"\\u0130li\\u015fkisel veritaban\\u0131 sistemleri ve query optimizasyonu.","tags":"MySql, PostgreSql, MSSql, Optimization"},{"icon":"fas fa-tools","title":"DevOPS & Tools","description":"Containerization ve modern development tooling","tags":"Docker, GIT, Linux, CI\\\\CD"}]',
            'principles' => '["Okunabilirlik, k\\u0131sal\\u0131ktan daha \\u00f6nemlidir","Test yaz\\u0131lmayan kod teknik bor\\u00e7tur","Yorum yerine iyi isimlendirme tercih ederim","Sistemler zamanla evrilmelidir, sert olmamal\\u0131d\\u0131r","Erken optimizasyon t\\u00fcm k\\u00f6t\\u00fcl\\u00fcklerin anas\\u0131d\\u0131r"]',
            'setup' => '{"os":"Windows/Linux", "editor":"VsCode", "terminal":"Bash", "db":"Navicat"}'
        ]);
    }
}

