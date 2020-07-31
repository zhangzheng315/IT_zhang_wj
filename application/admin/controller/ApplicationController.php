<?php


namespace app\admin\controller;


use app\common\model\Application;
use app\common\model\Product;
use app\common\services\application\ApplicationBaseController;
use app\common\services\product\ProductBase;
use think\Db;
use think\Request;

class ApplicationController extends BaseController
{
    public function index()
    {
        $db=new Application();
        $list=$db->select();
        return view('index',[
            'list'=>$list,
            'i'=>1
        ]);
    }
    /**
     * 新增系统介绍
     * */
    public function save()
    {
        $base=new ApplicationBaseController();
        return $base->picture();
    }
    /**
     * 渲染系统模板
     * */
    public function create(Request $request)
    {
        $input=$request->param();
        $db=new Application();
        if(isset($input['id'])){
            return view('application_create_edit',[
                'application_xg'=>true,
                'id'=>$input['id'],
                'list'=>$db->where('id',$input['id'])->find(),
            ]);
        }else{
            return view('application_create_edit',[
                'application_xg'=>false,
            ]);
        }
    }
    /**
     * 更改系统模板状态
     * */
    public function forbidden()
    {
        $application_basecontroller=new ApplicationBaseController();
        $data=[
            'status'=>input('status')==1 ? 0 : 1,
            'id'=>input('id')
        ];
        return $application_basecontroller->updatestatus($data);
    }
    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id='')
    {
        $db=new Application();
        $biaoji=$db->where('id',$id)->delete();
        return array('status'=>true,'msg'=>'删除成功');
    }
}