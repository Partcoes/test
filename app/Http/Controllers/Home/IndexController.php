<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * 前台首页
     */
    public function index(Request $request)
    {
        $userId = $request->session()->get('user_id');
        dump($userId);
        return view('home.index.index');
    }
}
