<?php

namespace app\admin\controller;

use app\common\services\little_title\LittleTitleService;
use think\Controller;
use think\Request;

class LittleTitleController extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
        $input = $request->param();
        $where = [];
        if (isset($input['little_title']) && !empty($input['little_title'])) {
            $where['little_title'] = array('like','%'.$input['little_title'].'%');
        }
        if (isset($input['start']) && isset($input['end'])) {
            if (!empty($input['start']) && empty($input['end'])) {
                $where['created_at'] = ['egt', $input['start']];
            }
            if (!empty($input['end']) && empty($input['start'])) {
                $where['created_at'] = ['elt', $input['end']];
            }
            if (!empty($input['start']) && !empty($input['end'])) {
                $where['created_at'] = array('between', [$input['start'], $input['end']]);
            }
        }

        $little_title_service = new LittleTitleService();
        $little_lists = $little_title_service->selectLittleTitle($where);
        $i = 1;
        return $this->fetch('index',compact('little_lists','i'));
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
        $little_title_service = new LittleTitleService();
        $rt = $little_title_service->createLittleTitle($input);
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

    /*
     * 禁启用
     * @param   $id
     */
    public function forbidden($id)
    {
        $little_title_service = new LittleTitleService();
        $title_status = $little_title_service->getStatusById($id);
        $data = [
            'id'       =>  $id,
            'status'   =>  $title_status == 1 ? 0 : 1,
        ];
        $rt = $little_title_service->updateStatus($data);
        return $rt ?
            ['status'=>true,'msg'=>'更改成功'] :
            ['status'=>false,'msg'=>'更改失败'] ;
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $little_title_service = new LittleTitleService();
        $info = $little_title_service->findLittleTitle($id);
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
        $little_title_service = new LittleTitleService();
        $rt = $little_title_service->updateLittleTitle($input);
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
        $little_title_service = new LittleTitleService();
        $rt = $little_title_service->deleteLittleTitle($id);
        return $rt ?
            ['status'=>true,'msg'=>'删除成功'] :
            ['status'=>false,'msg'=>'删除失败'];
    }
}
