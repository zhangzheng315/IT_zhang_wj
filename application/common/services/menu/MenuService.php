<?php


namespace app\common\services\menu;


use app\common\model\Menu;
use app\common\model\MenuGroup;

class MenuService
{
    /*
     * 删除菜单By$menu_group_id
     * @param   $menu_group_id
     */
    public function deleteMenuByGroupId($menu_group_id)
    {
        $where = [
            'pid'   =>  $menu_group_id
        ];
        $menu_model = new Menu();
        return $menu_model->where($where)->delete();
    }

    /*
     * 获取子级菜单
     */
    public function getMenus()
    {
        $menu_model = new Menu();
        return $menu_model->select();
    }

    /*
     * 查看新增的菜单名是否存在
     * @param   $menu_name
     */
    public function checkMenuName($menu_name,$id = null)
    {
        $where = [
            'id'    =>  array('neq',$id),
            'name'  =>  $menu_name,
        ];
        $menu_model = new Menu();
        $rt = $menu_model->where($where)->field('id')->find();
        return $rt ? $rt->id : false;
    }

    /*
     * 创建菜单
     * @param   $data
     */
    public function createMenu($data)
    {
        $date = date('Y-m-d H:i:s');
        $data['created_at'] = $date;
        $data['updated_at'] = $date;
        $menu_model = new Menu();
        $rt = $menu_model->data($data)->save();
        return $rt ? true : false;
    }

    /*
     * 获取菜单信息By $menu_id
     * @param   $menu_id
     */
    public function getMenuByMenuId($menu_id)
    {
        $menu_model = new Menu();
        return $menu_model->find($menu_id);
    }

    /*
     * 修改菜单
     */
    public function updateMenu($data)
    {
        $menu_mdel = new Menu();
        return $menu_mdel->update($data);
    }

    /*
     * 删除菜单
     * @param   $id
     */
    public function deleteMenu($id)
    {
        $where = [
            'id'    =>  $id
        ];
        $menu_model = new Menu();
        return $menu_model->where($where)->delete();
    }
}