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
    public function list($good_type = null)
    {
        $GoodModel = new GoodModel();
        $goodsList = $GoodModel->getRows($good_type);
        return view('home.goods.show',['goodsList'=>$goodsList]);
    }

    /**
     * 商品详细信息
     */
    public function detail($good_id)
    {
        $GoodModel = new GoodModel();
        $goodDetail = $GoodModel->getDetail($good_id);
        return view('home.goods.detail',['goodDetail'=>$goodDetail]);
    }
}
