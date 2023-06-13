<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryNames = [
            'Electronics',
            'Books',
            'Clothing',
            'Home Decor',
            'Sports',
            'Beauty',
            'Toys',
            'Automotive',
            'Health',
            'Food',
            'Pets',
            'Gardening',
            'Music',
            'Movies',
            'Travel',
        ];

        foreach ($categoryNames as $name) {
            Category::create([
                'name' => $name,
            ]);
        }
    }
}
