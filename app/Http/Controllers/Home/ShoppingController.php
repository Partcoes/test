<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShoppingController extends Controller
{
    /**
     * 购物车首页
     */
    public function index()
    {
        return view('home.shopping.index');
    }
}
