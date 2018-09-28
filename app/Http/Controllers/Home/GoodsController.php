<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Home\GoodModel;

class GoodsController extends Controller
{
    /**
     * 商品管理控制器
     */
    public function show($id)
    {
        $GoodModel = new GoodModel();
        $goodsList = $GoodModel->getRows($id);
        return view('home.goods.show',['goodsList'=>$goodsList]);
    }

    /**
     * 
     */
    public function index()
    {

    }
}
