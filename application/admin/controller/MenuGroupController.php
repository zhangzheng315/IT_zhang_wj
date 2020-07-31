<?php

namespace app\admin\controller;

use app\common\services\menu\MenuGroupService;
use think\Request;
use think\Validate;

class MenuGroupController extends BaseController
{
    /**
     * 显示资源列表
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
            'name' => 'require',
        ];
        $msg = [
            'name.require'  => '分组名必填',
        ];
        $validate = new Validate($rule, $msg);
        $result = $validate->check($input);
        if (!$result) {
            $this->error($validate->getError(), null, '', 1);
        }

        $menu_group_service = new MenuGroupService();
        $group_id = $menu_group_service->getMenuIdByGroupName($input['name']);
        if($group_id){
            return ['status'=>false,'msg'=>'分组已存在'];
        }
        $data = [
            'name'  =>  $input['name'],
            'icon'  =>  $input['icon'] ? $input['icon'] : '&#xe6b1;',
            'sort'  =>  $input['sort']
        ];
        $rt = $menu_group_service->createMenuGroup($data);
        if($rt){
            return ['status'=>true,'msg'=>'增加成功'];
        }else{
            return ['status'=>false,'msg'=>'增加失败'];
        }
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
    public function edit($menu_group_id)
    {
        $menu_group_service = new MenuGroupService();
        $info = $menu_group_service->getMenuGroupNameByGroupId($menu_group_id);
        $title = '编辑';
        $button = 'update';
        return $this->fetch('createOrEdit',compact('title','button','info'));
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int
     * @return \think\Response
     */
    public function update(Request $request)
    {
        $input = $request->param();
        $rule = [
            'name' => 'require',
        ];
        $msg = [
            'name.require'  => '分组名必填',
        ];
        $validate = new Validate($rule, $msg);
        $result = $validate->check($input);
        if (!$result) {
            $this->error($validate->getError(), null, '', 1);
        }

        $menu_group_service = new MenuGroupService();
        $id_where = ['id'=>array('neq',$input['id'])];
        $group_id = $menu_group_service->getMenuIdByGroupName($input['name'],$id_where);
        if($group_id){
            return ['status'=>false,'msg'=>'分组已存在'];
        }

        $rt = $menu_group_service->updateMenuGroup($input);
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
    public function delete($menu_group_id)
    {
        $menu_group_service = new MenuGroupService();
        $rt = $menu_group_service->deleteMenuGroup($menu_group_id);
        return $rt ?
            ['status'=>true,'msg'=>'删除成功'] :
            ['status'=>false,'msg'=>'删除失败'];
    }
}
