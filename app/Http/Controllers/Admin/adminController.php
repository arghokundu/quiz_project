<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\adminLoginRequest;
use App\Models\Admin\AdminModel;

class adminController extends Controller
{
    public function loginPage()
    {
        return view('login.adminLogin');
    }
    public function loginAdmin(adminLoginRequest $adlogReq)
    {
        
        return redirect('/');
    }
}
