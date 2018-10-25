<?php
namespace App\Services\Admin;

use \App\Model\Good;
use \App\Model\Brand;
use \App\Model\Attr;

class AttrService
{
    /**
     * 查找所有品牌
     */
    public function getAttrs()
    {
        return Attr::get();
    }
}