<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\GoodService;
use App\Services\Admin\TypeService;
use App\Services\Admin\AttrService;
use App\Services\Admin\ValueService;

class AttrsController extends Controller
{
    //定义变量
    protected $typeService;
    protected $goodService;
    protected $attrService;
    protected $valueService;

    /**
     * 初始化service
     */
    public function __construct()
    {
        $this->typeService = new TypeService();
        $this->goodService = new GoodService();
        $this->attrService = new AttrService();
        $this->valueService = new ValueService();
    }

    /**
     * 属性列表
     */
    public function list()
    {
        $attrs = $this->attrService->getAttrs();
        return view('admin.attrs.attrslist',['attrs'=>$attrs]);
    }

    /**
     * 添加属性页面
     */
    public function create()
    {
        return view('admin.attrs.attrcreate');
    }

    /**
     * 添加属性
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'attr_name' => 'required',
            ]);
            $result = $this->attrService->createAttr($request);
            if ($result) {
                return redirect('/warning')->with(['message'=>'保存成功','url'=>'/admin/attributes/list','jumpTime'=>3,'status'=>'true']);
            } else {
                return redirect('/warning')->with(['message'=>'保存失败','url'=>'/admin/attributes/create','jumpTime'=>3,'status'=>'false']);
            }
        }
    }

    /**
     * 删除属性
     */
    public function delete(Request $request)
    {
        $attrId = $request->input('attrId');
        $result = $this->attrService->deleteAttr();
        if ($result) {
            if ($result) {
                return redirect('/warning')->with(['message'=>'删除成功','url'=>'/admin/attributes/list','jumpTime'=>3,'status'=>'true']);
            } else {
                return redirect('/warning')->with(['message'=>'删除失败','url'=>'/admin/attributes/list','jumpTime'=>3,'status'=>'false']);
            }
        }
    }

    /**
     * 编辑属性
     */
    public function edit(Request $request)
    {
        if ($request->isMethod('post')) {
            $attr_id = $request->input('attr_id');
            $attr_name = $request->input('attr_name');
            $attr_values = $request->input('attr_values');
            $attr_values = explode('-',$attr_values);
            if ($this->attrService->updateAttr($attr_id,$attr_name) && $this->valueService->createAttrValue($attr_id,$attr_values)) {
                return redirect('/warning')->with(['message'=>'修改成功','url'=>'/admin/attributes/list','jumpTime'=>3,'status'=>'true']);
            } else {
                return redirect('/warning')->with(['message'=>'修改失败','url'=>'/admin/attributes/list','jumpTime'=>3,'status'=>'false']);
            }
        } else {
            $attrId = $request->attrId;
            $attrInfo = $this->attrService->getAttrById($attrId);
            $valueStr = $this->valueService->getValueById($attrId);
            return view('admin.attrs.attrandval',['attrInfo'=>$attrInfo,'valueStr'=>$valueStr]);
        }
        
    }
}
