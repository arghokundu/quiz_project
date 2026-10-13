<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\adminController;
use App\Http\Middleware\Admin\adminLogOrNot;
use App\Http\Controllers\Category\categoryController;

Route::get('/', function () {
    return view('layouts.mainApp');
});

Route::get('/login',[adminController::class,'loginPage']);
Route::post('/loginEntry',[adminController::class,'loginAdmin']);



Route::middleware(['adminAuth'])->group(function()
{
    Route::post('/logout',[adminController::class,'logoutAdmin']);
    // ===========category=============
    Route::get('/showAllCategory',[categoryController::class,'showAllCate']);
    Route::get('/categoryAdd',[categoryController::class,'addCat']);
    Route::post('/storecategory',[categoryController::class,'storeCat']);

    Route::get('/viewcatagory/{id}',[categoryController::class,'viewCat']);
});






