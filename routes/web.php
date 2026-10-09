<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.mainApp');
});

Route::view('/login','login.adminLogin');

Route::view('/register','login.adminRegister');







