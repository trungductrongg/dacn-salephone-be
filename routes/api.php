<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
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

Route::post('/admin/add-category', [CategoryProduct::class, 'add_category_product']);
Route::post('/admin/update-category/{id}', [CategoryProduct::class, 'update_category_product']);

Route::get('/admin/all-category', [CategoryProduct::class, 'all_category_product']);
Route::get('/admin/un-active/{id}', [CategoryProduct::class, 'unactive_category_product']);
Route::get('/admin/active/{id}', [CategoryProduct::class, 'active_category_product']);
Route::get('/admin/edit-category/{id}', [CategoryProduct::class, 'edit_category_product']);
