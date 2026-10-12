<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\adminController;
use App\Http\Middleware\Admin\adminLogOrNot;

Route::get('/', function () {
    return view('layouts.mainApp');
});

Route::get('/login',[adminController::class,'loginPage']);
Route::post('/loginEntry',[adminController::class,'loginAdmin']);



Route::middleware(['adminAuth'])->group(function()
{
    Route::post('/logout',[adminController::class,'logoutAdmin']);

});






