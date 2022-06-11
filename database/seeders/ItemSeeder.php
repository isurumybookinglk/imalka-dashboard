<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subCategories = SubCategory::all();
        $subCategories->each(function (SubCategory $subCategory) {
            Item::factory()->count(100)->create([
                'sub_category_id' => $subCategory->id,
            ]);
        });
    }
}
