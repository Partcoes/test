<?php
namespace App\Services\Admin;

use \App\Model\Good;
use \App\Model\Brand;
use \App\Model\Attr;
use \App\Model\Sku;
use DB;

class GoodService
{
    /**
     * 获取商品分页信息
     */
    public function GoodsListPagenate()
    {
        return Good::paginate(10);
    }

    /**
     * 通过商品id获取商品详情
     */
    public function getGoodDetail($goodId)
    {
        $goodInfo = Good::where(['good_id'=>$goodId])->first();
        return $goodInfo;
    }

    /**
     * 生成货号
     */
    public function createOsn(){
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');//年份映射对象
        $orderSn = $yCode[intval(date('Y')) - 2011]    //获取年份对应的映射值
            . strtoupper(dechex(date('m')))            //月份
            // . date('m')
            . date('d')                                //日期
            . substr(time(), -5)                       //当前时间戳 截取后5位
            . substr(microtime(), 2, 5)                //当前微秒数 截取
            . sprintf('%02d', rand(0, 99));            //随机数 并填充到两位数
        return $orderSn;
    }

    /**
     * 生成商品信息入库
     */
    public function createGoodInfo($goodInfo,$good_num)
    {
        $good = new Good();
        $good->good_sn = $this->createOsn();
        $good->good_name = $goodInfo['good_name'];
        $good->type_id = $goodInfo['type_id'];
        $good->description = $goodInfo['description'];
        $good->good_price = intval($goodInfo['good_price']*100);
        $good->good_num = $good_num;
        $good->create_time = $good->update_time = time();
        return $good;
    }
    
    /**
     * 处理sku信息
     */
    public function createSkuList($goodInfo)
    {
        $skuList = [];
        $sku = new Sku();
        $length = count($goodInfo['sku_strs']);
        for ($i = 0 ; $i < $length ; $i ++) {
            $skuList[$i]['sku_name'] = $goodInfo['sku_names'][$i];
            $skuList[$i]['sku_sn'] = 'Sn'.str_replace(',','',$goodInfo['sku_strs'][$i]).$goodInfo['sku_weights'][$i].rand(1000,9999);
            $skuList[$i]['sku_inventory'] = $goodInfo['sku_inventorys'][$i];
            $skuList[$i]['sku_price'] = $goodInfo['sku_prices'][$i];
            $skuList[$i]['sku_str'] = $goodInfo['sku_strs'][$i];
            $skuList[$i]['sku_weight'] = $goodInfo['sku_weights'][$i];
            $skuList[$i]['create_time'] = $skuList[$i]['update_time'] = time();
        }
        return $skuList;
    }

    /**
     * 处理商品属性管理
     */
    public function createGoodAttr($attr_values)
    {
        $goodAttrs = [];
        foreach ($attr_values as $key => $value) {
            foreach ($value as $k => $item) {
                $goodAttrs[] = [
                    'attr_id' => $key,
                    'attr_val_id' => $item,
                ];
            }
        }
        return $goodAttrs;
    }

    /**
     * 商品信息入库
     */
    public function insertGoodInfo($skuList,$goodAttrs,$goodInfo)
    {
        DB::beginTransaction();
        try {
            $goodInfo->save();
            foreach ($skuList as $key => $value) {
                $skuList[$key]['good_id'] = $goodInfo->good_id;
            }
            Sku::insert($skuList);
            foreach ($goodAttrs as $key => $value) {
                $goodAttrs[$key]['good_id'] = $goodInfo->good_id;
            }
            $good = new Good();
            $good->createGoodAttr($goodAttrs);
            $result = true;
            DB::commit();
            
        } catch (\Expection $e) {
            $result = $e->getMessage();
            DB::rollBack();
        }
        return $result;
    }
}