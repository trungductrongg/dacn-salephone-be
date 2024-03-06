<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AdminController::class, 'register']);
Route::post('/login', [AdminController::class, 'login']);
Route::post('/admin/login', [AdminController::class, 'adminLogin']);

//category product
Route::post('/admin/add-category', [CategoryProduct::class, 'add_category_product']);
Route::post('/admin/update-category/{id}', [CategoryProduct::class, 'update_category_product']);

Route::get('/admin/all-category', [CategoryProduct::class, 'all_category_product']);
Route::get('/admin/un-active/{id}', [CategoryProduct::class, 'unactive_category_product']);
Route::get('/admin/active/{id}', [CategoryProduct::class, 'active_category_product']);
Route::get('/admin/edit-category/{id}', [CategoryProduct::class, 'edit_category_product']);
Route::get('/admin/delete-category/{id}', [CategoryProduct::class, 'delete_category_product']);

//category brand

Route::post('/admin/add-brand', [BrandProduct::class, 'add_brand_product']);
Route::post('/admin/update-brand/{id}', [BrandProduct::class, 'update_brand_product']);

Route::get('/admin/all-brand', [BrandProduct::class, 'all_brand_product']);
Route::get('/admin/un-active-brand/{id}', [BrandProduct::class, 'unactive_brand_product']);
Route::get('/admin/active-brand/{id}', [BrandProduct::class, 'active_brand_product']);
Route::get('/admin/edit-brand/{id}', [BrandProduct::class, 'edit_brand_product']);
Route::get('/admin/delete-brand/{id}', [BrandProduct::class, 'delete_brand_product']);


//Product
Route::post('/admin/add-product', [ProductController::class, 'add_brand_product']);
Route::post('/admin/update-product/{id}', [ProductController::class, 'update_brand_product']);

Route::get('/admin/all-product', [ProductController::class, 'all_brand_product']);
Route::get('/admin/un-active-product/{id}', [ProductController::class, 'unactive_brand_product']);
Route::get('/admin/active-product/{id}', [ProductController::class, 'active_brand_product']);
Route::get('/admin/edit-product/{id}', [ProductController::class, 'edit_brand_product']);
Route::get('/admin/delete-product/{id}', [ProductController::class, 'delete_brand_product']);