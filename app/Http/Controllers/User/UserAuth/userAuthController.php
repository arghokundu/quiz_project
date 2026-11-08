<?php

namespace App\Http\Controllers\User\UserAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\UserAuthM\userAuthModel;
use App\Http\Requests\User\RegRequest;
use App\Http\Requests\User\LogRequest;

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
    public function userLogin(LogRequest $logR)
    {
        try
        {
            $userReqEmail=$logR->user_email;
            $userReqPassword=$logR->User_password;
            $checkUserlogExistsOrNot=userAuthModel::select('userEmail','user_id','userPassword','Active_status','userName')
                ->where('userEmail','=',$userReqEmail)->first();
            if(!$checkUserlogExistsOrNot || !Hash::check($userReqPassword,$checkUserlogExistsOrNot->userPassword))
            {
                return back()->with('error','Email Not Exists Please Register First');
            }
            else
            {
                $logR->session()->regenerate();
                session([
                    'userId'=>$checkUserlogExistsOrNot->user_id,
                    'userEmailId'=>$checkUserlogExistsOrNot->userEmail,
                    'usersName'=>$checkUserlogExistsOrNot->userName,
                    'userActiveStatus'=>$checkUserlogExistsOrNot->Active_status,
                ]);
                return redirect('/')->with('success','user Successfully Login');
            }
        }
        catch(\Exception $e)
        {
            return back()->with('error',$e->getMessage());
        }
        
    }
}
