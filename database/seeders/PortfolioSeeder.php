<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run()
{
    \App\Models\Portfolio::create([
        'title' => 'Test Photo',
        'description' => 'Test Description',
        'media_url' => 'https://example.com/test.jpg',
        'type' => 'photo',
        'is_featured' => true
        ]);
    }
}
