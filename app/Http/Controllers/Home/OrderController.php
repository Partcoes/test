<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * 订单列表
     */
    public function list()
    {
        return view('home.order.list');
    }
}
