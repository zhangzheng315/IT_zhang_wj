<?php

namespace app\admin\controller;

use app\common\model\System;
use app\common\services\system\SystemBase;
use think\Controller;
use think\Request;

class SystemController extends BaseController
{

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $db=new System();
        $list=$db->select();
        return view('index',[
            'list'=>$list
        ]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request)
    {
        $data=[
            'name'=>input('name'),
            'title'=>input('title'),
            'keyword'=>input('keyword'),
            'describe'=>input('describe'),
            'Statistics'=>input('Statistics'),
            'wx'=>input('wx'),
            'tel'=>input('tel'),
            'keeps'=>input('keeps')
        ];
        $systemBase=new SystemBase();
        return $systemBase->updatesystem($data);
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
