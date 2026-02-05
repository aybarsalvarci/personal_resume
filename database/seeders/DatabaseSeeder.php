<?php

namespace Database\Seeders;

use App\Models\Blog;
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
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
        ]);

        ProjectCategory::factory(10)
            ->has(Project::factory()->count(10), 'projects')
            ->create();
    }
}
