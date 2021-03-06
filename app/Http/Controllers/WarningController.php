<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WarningController extends Controller
{
    /**
     * 跳转提示
     */
    public function index()
    {
        if(!empty(session('message')) && !empty(session('url')) && !empty(session('jumpTime'))){
            $data = [
                'message' => session('message'),
                'url' => session('url'),
                'jumpTime' => session('jumpTime')?:3,
                'status' => session('status')?:false,
            ];
        } else {
            $data = [
                'message' => '非法访问！',
                'url' => "/",
                'jumpTime' => 3,
                'status' => false
            ];
        }
        return view('warning.index',['data' => $data]);
    }
}
