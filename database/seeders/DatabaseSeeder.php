<?php

namespace Database\Seeders;
use App\Models\Users;
use App\Models\Posts;
use App\Models\Tags;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Users::factory()
            ->has(Posts::factory()->count(3)->hasAttached(Tags::factory()->count(2)))
            ->create();
    }
}
