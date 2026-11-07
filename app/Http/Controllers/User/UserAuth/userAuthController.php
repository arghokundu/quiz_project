<?php

namespace App\Http\Controllers\User\UserAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class userAuthController extends Controller
{
    public function userRegForm()
    {
        return view('User.userAuthPage.userReg');
    }
    public function userLogForm()
    {
        return view('User.userAuthPage.userLogin');
    }
}
