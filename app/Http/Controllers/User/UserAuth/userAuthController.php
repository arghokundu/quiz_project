<?php

namespace App\Http\Controllers\User\UserAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\UserAuthM\userAuthModel;
use App\Http\Requests\User\RegRequest;

class userAuthController extends Controller
{
    public function userRegForm()
    {
        return view('User.userAuthPage.userReg');
    }
    public function storeUserRegData(RegRequest $regR)
    {
        DB::beginTransaction();
        try
        {
            $userReqEmail=$regR->User_Email;
            $checkUserExistsOrNot=userAuthModel::select('userEmail')->where('userEmail','=',$userReqEmail)->first();
            if($checkUserExistsOrNot)
            {
                DB::rollback();
                return back()->with('error','Email Already Exists');
            }
            $userAuthData=new userAuthModel();
            $userAuthData->userName=strtoupper($regR->User_Name);
            $userAuthData->userEmail=$userReqEmail;
            $userAuthData->userPassword=Hash::make($regR->user_Password);
            // user Active status [0=delete,1=active,2=active and verified] 
            $userAuthData->Active_status=1;
            $savedUserData=$userAuthData->save();
            if($savedUserData)
            {
                DB::commit();
                return redirect('/user/login/form')->with('success','Registration Successfully Done');
            }
            else
            {
                return back()->with('error','something went wrong');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->with('error',$e->getMessage());
        }
    }
    public function userLogForm()
    {
        return view('User.userAuthPage.userLogin');
    }
    
}
