<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SettingSeeder::class,
            HomePageSeeder::class,
        ]);

        User::create([
            'name' => 'Aybars',
            'email' => 'aybarsalvarci44@gmail.com',
            'password' => bcrypt('123890_123890_Saay4'),
        ]);


    }
}
