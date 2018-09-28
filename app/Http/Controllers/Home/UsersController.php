<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * 
     */
    public function show($type)
    {
        if($type == 'login'){
            return view('home.users.login');
        }else if($type == 'register'){
            return view('home.users.register');
        }
    }

    /**
     * 
     */
    public function store(Request $request)
    {
        $data = $request->input();
        if($data['submit'] == '立即登录') {
            return 'login';
        }else if($data['submit'] == '立即注册'){
            return "register";
        }
    }
}
