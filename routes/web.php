<?php
  
   use TestTask\Http\Route;
   use App\Controllers\ProductController;
   use App\Controllers\UserController;


  
    Route::get('/product/index' ,[ProductController::class,'index']);
    Route::get('/product/create' ,[ProductController::class,'create']);
    Route::post('/insertProduct',  [ProductController::class,'insertProduct']);
    Route::post('/product' ,[ProductController::class,'store']);
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/user', [UserController::class, 'store']);
    Route::get('/api/product/{sku}', [ProductController::class, 'getProductBySku']);

    // Route::get('/api/products', [ProductController::class, 'getProductData']);
    Route::post('/product/mass-delete', [ProductController::class, 'massDelete']);


//  <?php

// use App\Controllers\ProductController;
// use TestTask\Http\Route;

// Route::get('/', [ProductController::class, 'index']);

// Route::get('/product/create', [ProductController::class, 'create']);

// Route::post('/product/store', [ProductController::class, 'store']);

// Route::post('/product/mass-delete', [ProductController::class, 'delete']);