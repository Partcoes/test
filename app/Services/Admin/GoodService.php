<?php
namespace App\Services\Admin;

use \App\Model\Good;
use \App\Model\Brand;
use \App\Model\Attr;

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
     * 处理商品数据
     */
    public function createGoodInfo($data)
    {
        $news = $data['news'];
        foreach ($news as $key => $value) {
            if(!empty($value)) {
                $values = explode('-',$value);
                foreach ($values as $k => $item) {
                    $data['attr_values'][$key][] = Value::insertGetId(['attr_id'=>$key,'attr_val_name'=>$item]);
                }
            }
        }
        $good = new Good();
        $good->good_sn = $this->createOsn();
        $good->good_name = $data['good_name'];
        $good->type_id = $data['type_id'];
        $good->description = $data['description'];
        $good->good_price = intval($data['good_price']*100);
        $good->good_num = $data['good_num'];
        $good->is_delete = 0;
        $good->good_img = isset($data['good_img'])?$data['good_img']:'';
        $good->create_time = $good->update_time = time();
        $good->save();
        return $good->good_id;
    }
}