<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GoodsController extends Controller
{
    //商品管理控制器
    public function show($id)
    {
        $data = DB::table('goods')->where('good_id',$id)->first();
        return view('home.goods.show');
    }
}
