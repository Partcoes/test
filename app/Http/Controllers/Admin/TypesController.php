<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\GoodService;
use App\Services\Admin\TypeService;
use App\Services\Admin\AttrService;

class TypesController extends Controller
{
    //定义变量
    protected $typeService;
    protected $goodService;
    protected $attrService;

    /**
     * 初始化service
     */
    public function __construct()
    {
        $this->typeService = new TypeService();
        $this->goodService = new GoodService();
        $this->attrService = new AttrService();
    }

    /**
     * 商品分类展示
     */
    public function list()
    {
        $types = $this->typeService->getTypesPaginate();
        return view('admin.types.typelist',['types'=>$types]);
    }

    /**
     * 商品分类添加表单
     */
    public function create()
    {
        $types = $this->typeService->getTypes();
        return view('admin.types.typecreate',['types'=>$types]);
    }

    /**
     * 分类添加操作
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'type_name' => 'required',
                'type_url' => 'regex:/^(\/[a-z]{3,})+$/',
                'parent_id' => 'required',
            ]);
            $fileUpload = '';
            if ($request->file('type_img')) {
                $fileUpload = $this->typeService->fileUpload($request);
            }
            $createType = $this->typeService->createType($request,$fileUpload);
            if ($createType) {
                return redirect('/warning')->with(['message'=>'保存成功','url'=>'/admin/types/list','jumpTime'=>3,'status'=>'true']);
            } else {
                return redirect('/warning')->with(['message'=>'保存失败','url'=>'/admin/types/create','jumpTime'=>3,'status'=>'false']);
            }
        }
    }

    /**
     * 删除分类
     */
    public function delete(Request $request)
    {
        $typeId = $request->input('typeId');
        $result = $this->typeService->deleteType($typeId);
        if ($result) {
            return redirect('/warning')->with(['message'=>'删除成功','url'=>'/admin/types/list','jumpTime'=>3,'status'=>'true']);
        } else {
            return redirect('/warning')->with(['message'=>'删除失败','url'=>'/admin/types/create','jumpTime'=>3,'status'=>'false']);
        }
    }

    /**
     * 修改分类
     */
    public function edit(Request $request)
    {
        $typeId = $request->input('typeId');
        $typeInfo = $this->typeService->getTypesById($typeId);
        $types = $this->typeService->getTypes();
        return view('admin.types.typecreate',['typeInfo'=>$typeInfo,'types'=>$types]);
    }

    /**
     * 为分类添加属性
     */
    public function getAttrsForm(Request $request)
    {
        $typeId = $request->input('typeId');
        $attrs = $this->attrService->getAttrs();
        $defaultType = $this->typeService->getTypesById($typeId);
        $attrsArr = [];
        foreach ($defaultType->attrs as $key => $value) {
            $attrsArr[] = $value->attr_id;
        }
        return view('admin.types.getattrs',['attrs'=>$attrs,'defaultType'=>$defaultType,'attrsArr'=>$attrsArr]);
    }

    /**
     * 添加属性功能
     */
    public function getattrs(Request $request)
    {
        $result = $this->typeService->getAttrsForType($request);
        if ($result) {
            return redirect('/warning')->with(['message'=>'添加成功','url'=>'/admin/types/list','jumpTime'=>3,'status'=>'true']);
        } else {
            return redirect('/warning')->with(['message'=>'添加失败','url'=>'/admin/types/getattrsform','jumpTime'=>3,'status'=>'true']);
        }
    }
}
