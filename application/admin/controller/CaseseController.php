<?php

namespace app\admin\controller;

use app\common\services\casese\CaseseService;
use think\Controller;
use think\Request;

class CaseseController extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $casese_service = new CaseseService();
        $case_lists = $casese_service->selectCase();
        $i = 1;
        return $this->fetch('index',compact('case_lists','i'));
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $title = '新增';
        $button = 'add';
        return $this->fetch('createOrEdit',compact('button','title'));
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $input = $request->param();
        $file = $request->file();
        $casese_service = new CaseseService();
        $rt = $casese_service->createCase($input,$file);
        return $rt ?
            ['status'=>true,'msg'=>'新增成功'] :
            ['status'=>false,'msg'=>'新增失败'];
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
        $casese_service = new CaseseService();
        $info = $casese_service->getCase($id);
        $title = '编辑';
        $button = 'update';
        return $this->fetch('createOrEdit',compact('button','title','info'));
    }

    /*
     * 案例禁启用
     */
    public function forbidden($id)
    {
        $casese_service = new CaseseService();
        $case_status = $casese_service->getStatusById($id);
        $data = [
            'id'       =>  $id,
            'status'   =>  $case_status == 1 ? 0 : 1,
        ];
        $rt = $casese_service->updateStatus($data);
        return $rt ?
            ['status'=>true,'msg'=>'更改成功'] :
            ['status'=>false,'msg'=>'更改失败'] ;
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
        $input = $request->param();
        $file = $request->file();
        $casese_service = new CaseseService();
        $rt = $casese_service->updateCase($input,$file);
        return $rt ?
            ['status'=>true,'msg'=>'编辑成功'] :
            ['status'=>false,'msg'=>'编辑失败'];
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $casese_service = new CaseseService();
        $rt = $casese_service->deleteCase($id);
        return $rt ?
            ['status'=>true,'msg'=>'删除成功'] :
            ['status'=>false,'msg'=>'删除失败'];
    }
}
