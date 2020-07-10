<?php

namespace app\admin\controller;

use app\common\services\menu\MenuService;
use think\Request;
use think\Validate;

class MenuController extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $i = 1;
        return $this->fetch('index',compact('i'));
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
        return $this->fetch('createOrEdit',compact('title','button'));
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
            'pid'   =>  'require',
            'name'  =>  'require',
            'url'   =>  'require'
        ];
        $msg = [
            'pid.require'  => '父级菜单必填',
            'name.require'  => '菜单名必填',
            'url.require'  => '菜单URL必填',
        ];
        $validate = new Validate($rule, $msg);
        $result = $validate->check($input);
        if (!$result) {
            $this->error($validate->getError(), null, '', 1);
        }

        $menu_service = new MenuService();
        $outh_id = $menu_service->checkMenuName($input['name']);
        if ($outh_id) {
            return ['status'=>false,'msg'=>'菜单已存在'];
        }
        $rt = $menu_service->createMenu($input);
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
    public function edit($menu_id)
    {

        $menu_service = new MenuService();
        $info = $menu_service->getMenuByMenuId($menu_id);
        $title = '编辑';
        $button = 'update';
        return $this->fetch('createOrEdit',compact('title','button','info'));
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
        $rule = [
            'pid'   =>  'require',
            'name'  =>  'require',
            'url'   =>  'require'
        ];
        $msg = [
            'pid.require'  => '父级菜单必填',
            'name.require'  => '菜单名必填',
            'url.require'  => '菜单URL必填',
        ];
        $validate = new Validate($rule, $msg);
        $result = $validate->check($input);
        if (!$result) {
            $this->error($validate->getError(), null, '', 1);
        }

        $menu_service = new MenuService();
        $outh_id = $menu_service->checkMenuName($input['name'],$input['id']);
        if ($outh_id) {
            return ['status'=>false,'msg'=>'菜单已存在'];
        }

        $rt = $menu_service->updateMenu($input);
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
    public function delete($menu_id)
    {
        $menu_service = new MenuService();
        $rt = $menu_service->deleteMenu($menu_id);
        return $rt ?
            ['status'=>true,'msg'=>'删除成功'] :
            ['status'=>false,'msg'=>'删除失败'];
    }
}
