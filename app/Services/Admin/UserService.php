<?php
namespace App\Services\Admin;

use Illuminate\Support\Facades\Cookie;
use App\Model\Manager;

class UserService
{
    public function userLogin($request)
    {
        $formInfo = $request->input();
        $managerInfo = Manager::where(['manager_name'=>$formInfo['email'],'manager_pwd'=>md5($formInfo['password'])])->first();
        if (isset($managerInfo->manager_id)) {
            $managerInfo->last_login_time = time();
            $managerInfo->save();
            session()->put('managerInfo',$managerInfo);
            return true;
        } else {
            return false;
        }
    }
}