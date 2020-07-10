<?php


namespace app\admin\controller;

use app\common\services\user\UserBaseService;
use think\Controller;
use think\Request;

class LoginController extends Controller
{
    public function index()
    {
        return $this->fetch('index');
    }

    /*
     * 登陆验证
     *
     */
    public function postLogin(Request $request)
    {
        $input = $request->param();
        $user_base_service = new UserBaseService();
        $user_id = $user_base_service->getUserIdByUserName($input['user_name']);
        if(!$user_id){
            return ['status'=>false,'msg'=>'用户不存在'];
        }
        $user_status = $user_base_service->getUserStatusByUserId($user_id);
        if($user_status == 0){
            return ['status'=>false,'msg'=>'该账户没有权限登陆'];
        }
        $rt = $user_base_service->checkPassword($input['password'],$user_id);
        if(!$rt){
            return ['status'=>false,'msg'=>'用户名或密码不正确'];
        }else{
            session('user',$input);
            return ['status'=>true];
        }
    }
}