<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * 小米商城后台首页
     */
    public function index()
    {
        // dump(session()->get('adminUserInfo')['user_name']);
        return view('admin.index.index');
    }
}
