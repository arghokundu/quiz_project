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
        $checkUserExists=AdminModel::select('admin_id','name','emailId','password','role')
            ->where('emailId','=', $adlogReq->useremail)->where('password','=', $adlogReq->userpassword)->first();

        if($checkUserExists)
        {
            // Store admin details in session
            session([
                'adminId' => $checkUserExists->admin_id,
                'adminName' => $checkUserExists->name,
                'adminEmail' => $checkUserExists->emailId,
                'adminRole' => $checkUserExists->role,
            ]);
            return view('layouts.mainApp');
        }
        else
        {
            return redirect('/login')->with('error','Admin Does not exists');
        }
    }
    public function logoutAdmin(Request $adlogReq)
    {
        $adlogReq->session()->forget([
            'adminId',
            'adminName',
            'adminEmail',
            'adminRole'
        ]);

        $adlogReq->session()->invalidate();
        $adlogReq->session()->regenerateToken();
            
        return redirect('/login')->header('Cache-Control','no-store, no-cache, must-revalidate, max-age=0, private')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}