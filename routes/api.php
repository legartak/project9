<?php

use App\Http\Controllers\Api as Controllers;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->controller(Controllers\AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
});

Route::prefix('categories')->name('categories.')->controller(Controllers\CategoriesController::class)->group(function () {
    Route::get('/', 'allCategories')->name('allCategories');
    Route::get('/{id}', 'byId')->name('byId');
    Route::get('/{id}/goods', 'goodsWithId')->middleware('auth:api')->name('goodsWithId');
});

Route::prefix('modify')->name('modify.')->controller(Controllers\ModifyTablesController::class)->middleware('auth:api')->group(function () {
    Route::post('/category/add', 'addCategory')->name('addCategory');
    Route::post('/goods/add', 'addGoods')->name('addGoods');
    Route::put('/goods/update/{id}', 'updateGoods')->name('updateGoods');
    Route::put('/category/update/{id}', 'updateCategory')->name('updateCategory');
});
