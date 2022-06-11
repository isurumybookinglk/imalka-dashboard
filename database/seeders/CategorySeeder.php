<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::factory()->count(10)->create();
        
        // create sub categories
        $categories->each(function ($category) {
            SubCategory::factory()->count(5)->create([
                'category_id' => $category->id,
            ]);
        });
    }
}
