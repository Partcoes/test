<?php
namespace App\Services\Admin;

use \App\Model\Good;
use \App\Model\Type;
use \App\Model\Attr;

class TypeService
{
    /**
     * 查找所有品牌
     */
    public function getTypes()
    {
        return Type::orderBy('path')->get();
    }
}