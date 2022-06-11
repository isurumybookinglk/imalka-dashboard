<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

# get all clients
Route::get('/clients', [ClientController::class, 'list'])
    ->name('clients.list');
# get all categories
Route::get('/categories', [CategoryController::class, 'list'])
    ->name('categories.list');
# get all sub categories
Route::get('/sub-categories/{category}', [SubCategoryController::class, 'list'])
    ->name('sub-categories.list');
# get all items for a sub category
Route::get('/items/{subCategory}', [ItemController::class, 'bySubCategory'])
    ->name('items.list-by-sub-category');
# add order item
Route::post('/orders', [OrderController::class, 'add'])
    ->name('orders.add');
# get all orders
Route::get('/orders', [OrderController::class, 'list'])
    ->name('orders.list');
