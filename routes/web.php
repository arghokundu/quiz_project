<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\adminController;

Route::get('/', function () {
    return view('layouts.mainApp');
});

Route::get('/login',[adminController::class,'loginPage']);
Route::post('/loginEntry',[adminController::class,'loginAdmin']);

// Route::view('/adminlogin','login.adminLogin');
// Route::view('/adminregister','login.adminRegister');







