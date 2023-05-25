<?php
  
   use TestTask\Http\Route;
   use App\Controllers\ProductController;
   use App\Controllers\UserController;


    Route::get('/', [UserController::class, 'index']);
    Route::get('/product/index' ,[ProductController::class,'index']);
    Route::get('/product/create' ,[ProductController::class,'create']);
    Route::post('/insertProduct',  [ProductController::class,'insertProduct']);
    Route::post('/product' ,[ProductController::class,'store']);
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/user', [UserController::class, 'store']);
    Route::get('/api/product/{sku}', [ProductController::class, 'getProductBySku']);

    Route::post('/product/mass-delete', [ProductController::class, 'massDelete']);

