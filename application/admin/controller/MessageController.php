<?php

namespace app\admin\controller;

use app\common\services\message\MessageService;
use think\Controller;
use think\Request;

class MessageController extends BaseController
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
        if (isset($input['phone']) && !empty($input['phone'])) {
            $where['phone'] = array('like','%'.$input['phone'].'%');
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

        $message_service = new MessageService();
        $message_lists = $message_service->selectMessage($where);
        $i = 1;
        return $this->fetch('index',compact('i','message_lists'));
    }

    /*
     * 修改申请状态
     * @param   $id
     */
    public function handle($id)
    {
        $message_service = new MessageService();
        $rt = $message_service->updateMessageStatus($id);
        return $rt ?
            ['status'=>true,'msg'=>'操作成功'] :
            ['status'=>false,'msg'=>'操作失败'] ;
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $message_service = new MessageService();
        $rt = $message_service->deleteMessage($id);
        return $rt ?
            ['status'=>true,'msg'=>'删除成功'] :
            ['stauts'=>false,'msg'=>'删除失败'];
    }
}
