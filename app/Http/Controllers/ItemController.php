<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function bySubCategory(SubCategory $subCategory)
    {
        $items = Item::where('sub_category_id', $subCategory->id)->get();
        return $items;
    }
}
