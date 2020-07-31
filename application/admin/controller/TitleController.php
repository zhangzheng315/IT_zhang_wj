<?php

namespace app\admin\controller;

use app\common\services\title\TitleService;
use think\Request;

class TitleController extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $title_service = new TitleService();
        $title_list = $title_service->selectTitle();
        $i = 1;
        return $this->fetch('index',compact('title_list','i'));
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
        $title_service = new TitleService();
        return $title_service->createTitle($input);

    }

    /*
     * 案例禁启用
     */
    public function forbidden($id)
    {
        $title_service = new TitleService();
        $title_status = $title_service->getStatusById($id);
        $data = [
            'id'       =>  $id,
            'status'   =>  $title_status == 1 ? 0 : 1,
        ];
        $rt = $title_service->updateStatus($data);
        return $rt ?
            ['status'=>true,'msg'=>'更改成功'] :
            ['status'=>false,'msg'=>'更改失败'] ;
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
        $title_service = new TitleService();
        $info = $title_service->getTitleInfo($id);
        $title = '编辑';
        $button = 'update';
        return $this->fetch('createOrEdit',compact('button','title','info'));
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
        $title_service = new TitleService();
        $rt = $title_service->updateTitle($input);
        return $rt ?
            ['status'=>true,'msg'=>'修改成功'] :
            ['status'=>false,'msg'=>'修改失败'];
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $title_service = new TitleService();
        $rt = $title_service->deleteTitle($id);
        return $rt ?
            ['status'=>true,'msg'=>'删除成功'] :
            ['status'=>false,'msg'=>'删除失败'];
    }
}
