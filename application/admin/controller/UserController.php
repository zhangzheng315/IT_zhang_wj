<?php

namespace app\admin\controller;

use app\common\services\user\UserBaseService;
use think\Controller;
use think\Request;
use think\Validate;

class UserController extends BaseController
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
        if (isset($input['username']) && !empty($input['username'])) {
            $where['user_name'] = array('like','%'.$input['username'].'%');
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
        $user_base_service = new UserBaseService();
        $lists = $user_base_service->paginate($where);
        $i = 1;
        return $this->fetch('index',compact('lists','i'));
    }

    /*
     * 用户禁启用
     *
     */
    public function forbidden($user_id)
    {
        if($user_id==1){
            return ['status'=>false,'msg'=>'最高管理者禁止更改'];
        }
        $user_base_service = new UserBaseService();
        $user_status = $user_base_service->getUserStatusByUserId($user_id);
        $data = [
            'user_id'       =>  $user_id,
            'user_status'   =>  $user_status == 1 ? 0 : 1,
        ];
        $rt = $user_base_service->updateUserStatus($data);
        return $rt ?
            ['status'=>true,'msg'=>'更改成功'] :
            ['status'=>false,'msg'=>'更改失败'] ;
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
        $rule = [
            'username' => 'require|min:2',
            'password' => 'require|min:6',
            'phone' => 'require|length:11',
        ];
        $msg = [
            'username.require'  => '登录名必填',
            'password.require'  => '密码必填',
            'password.min'      => '密码长度不能小于 6 个字母',
            'phone.length'      =>  '手机号长度应为11位',
        ];
        $validate = new Validate($rule, $msg);
        $result = $validate->check($input);
        if (!$result) {
            $this->error($validate->getError(), null, '', 1);
        }

        $user_base_service = new UserBaseService();
        $auth_id = $user_base_service->getUserIdByUserName($input['username']);
        if($auth_id){
            return '用户已存在';
        }

        $data = [
            'user_name' =>  $input['username'],
            'password'  =>  md5($input['password']),
            'phone'     =>  $input['phone']
        ];
        $rt = $user_base_service->createUserInformation($data);
        return $rt ? true : false ;

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
     * @param  int  $user_id
     * @return \think\Response
     */
    public function edit($user_id)
    {
        $user_base_service = new UserBaseService();
        $info = $user_base_service->getUserInformation($user_id);
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
        if($input['user_id'] == 1){
            return ['status'=>true,'msg'=>'最高管理者禁止修改'];
        }
        $data = [
            'user_id'   =>  $input['user_id'],
            'user_name' =>  $input['user_name'],
            'phone'     =>  $input['phone']
        ];
        $user_base_service = new UserBaseService();
        $rt = $user_base_service->updateUserInfomation($data);
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
    public function delete($user_id)
    {
        if($user_id == 1){
            return ['status'=>true,'msg'=>'最高管理者禁止删除'];
        }
        $user_base_service = new UserBaseService();
        $rt = $user_base_service->deleteUser($user_id);
        return $rt ?
            ['status'=>true,'msg'=>'删除成功'] :
            ['stauts'=>false,'msg'=>'删除失败'];
    }
}
