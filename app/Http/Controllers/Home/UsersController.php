<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\UserModel;

class UsersController extends Controller
{
    /**
     * 使用模型查找用户信息
     */
    public function index()
    {
        $id = 1;
        $User = new UserModel();
        $userInfo = $User->getUserInfo($id);
        dd($userInfo);
    }
}
