<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GoodsController extends Controller
{
    /**
     * 商品管理控制器
     */
    public function show($id)
    {
        $goodsList = DB::table('goods')->where('good_type',$id)->get();
        return view('home.goods.show',['data'=>$data]);
    }

    /**
     * 
     */
    public function index()
    {

    }
}
