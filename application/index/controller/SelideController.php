<?php


namespace app\index\controller;


use app\common\model\Application;
use app\common\model\Casese;
use app\common\model\ProductContent;
use app\common\services\index\IndexBaseController;
use think\Controller;
use think\Request;

class SelideController extends IndexBaseController
{
    public function index(Request $request)
    {
        switch (key(input())){
            case 'pid':
                $db=new ProductContent();
                $list=$db->where('p_id',input('pid'))->find();
                return view('index',[
                    'lists'=>$list,
                    'name'=>'产品介绍'
                ]);
                break;
            case 'application_id':
                $db=new Application();
                $list=$db->where('id',input('application_id'))->find();
                return view('index',[
                    'lists'=>$list,
                    'name'=>'应用领域'
                ]);
                break;
            case 'case_id':
                $db = new Casese();
                $list = $db->where('id',input('case_id'))->find();
                return view('index',[
                    'lists'  =>  $list,
                    'name'  =>  '案例展示'
                ]);
                break;
        }
    }
}