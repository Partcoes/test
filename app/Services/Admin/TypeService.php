<?php
namespace App\Services\Admin;

use \App\Model\Good;
use \App\Model\Type;
use \App\Model\Attr;
use DB;
use App\Http\Controllers\Controller;

class TypeService extends Controller
{
    /**
     * 查找所有品牌
     */
    public function getTypes()
    {
        return Type::orderBy('path')->where(['is_delete'=>1])->get();
    }

    /**
     * 分页查找分类
     */
    public function getTypesPaginate()
    {
        return Type::orderBy('path')->where(['is_delete'=>1])->paginate(10);
    }

    /**
     * 通过id获取分类信息
     */
    public function getTypesById($typeId)
    {
        return Type::where(['type_id'=>$typeId,'is_delete'=>1])->first();
    }

    /**
     * 添加分类
     */
    public function createType($request,$fileUpload)
    {
        $parentPath = Type::select('path')->where(['type_id'=>$request->input('parent_id')])->first();
        if (isset($parentPath->path)) {
            $parentPath = $parentPath->path;
        } else {
            $parentPath = '';
        }
        if (isset($request->type_id)) {
            $types = Type::where(['type_id'=>$request->input('type_id')])->first();
        } else {
            $types = new Type();
        }
        $types->type_name = $request->input('type_name');
        $types->type_url = $request->input('type_url');
        $types->parent_id = $request->input('parent_id');
        if ($fileUpload != '') {
            $types->type_img = $fileUpload;
        }
        $types->path = $parentPath;
        DB::beginTransaction();
        try {
            $types->save();
            $type_id = $types->type_id;
            $types->path = $parentPath!=''?$parentPath.'-'.$type_id:$type_id;
            $types->save();
            $result = true;
            DB::commit();
        } catch (\Expection $e) {
            $result = $e->getMessage();
            DB::rollBack();
        }
        return $result;
    }
    
    /**
     * 删除分类
     */
    public function deleteType($typeId)
    {
        $type = new Type();
        DB::beginTransaction();
        try {
            $type->where(['type_id'=>$typeId])->update(['is_delete'=>0]);
            $type->deleteReletive($typeId);
            $result = true;
            DB::commit();
        } catch (\Expection $e) {
            $result = $e->getMessage();
            DB::rollBack();
        }
        return $result;
    }

    /**
     * 为分类添加属性
     */
    public function getAttrsForType($request)
    {
        $typeId = $request->input('type_id');
        $attrs = $request->input('attrs');
        $type = new Type();
        DB::beginTransaction();
        try {
            $type->deleteReletive($typeId);
            $type->getAttrsForType($typeId,$attrs);
            $result = true;
            DB::commit();
        } catch (\Expection $e) {
            $result = $e->getMessage();
            DB::rollBack();
        }
        return $result;
    }

    /**
     * 通过分类id获取属性
     */
    public function getAttrsBytype($typeId)
    {
        $type = new Type();
        $attrs = $type->getAttrIds($typeId);
        foreach ($attrs as $key => $value) {
            $attrIds[] = $value->attr_id;
        }
        $attrsInfo = Attr::whereIn('attr_id',$attrIds)->get();
        foreach ($attrsInfo as $key => $value) {
            $data[$key]['attr_id'] = $value->attr_id;
            $data[$key]['attr_name'] = $value->attr_name;
        }
        return $data;
    }
}