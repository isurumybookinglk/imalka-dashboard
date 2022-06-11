<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function list(Category $category)
    {
        return SubCategory::where('category_id', $category->id)->get();
    }
}
