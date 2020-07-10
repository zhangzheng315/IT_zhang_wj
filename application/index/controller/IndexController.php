<?php
namespace app\index\controller;

use app\common\model\Images;
use think\Controller;

class IndexController extends  Controller
{
    public function index()
    {
        $ix=new Images();
        $map['status']=['like','%'.'1'.'%'];
        $map['ifcation_id']=['like','%'.'1'.'%'];

        $list=$ix->where($map)->select();
        return view('index',[
            'list'=>$list,
            'page'=>count($list)
        ]);
    }
}
