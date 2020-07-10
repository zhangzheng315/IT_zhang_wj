<?php


namespace app\common\services\menu;


use app\common\model\Menu;
use app\common\model\MenuGroup;
use think\Db;

class MenuGroupService
{
    /*
     * 获取菜单分组
     */
    public function getMenuGroups()
    {
        $menu_group_model = new MenuGroup();
        return $menu_group_model->order('sort asc')->select();
    }

    /*
     * 查看分组名是否存在
     * @param   $group_name
     */
    public function getMenuIdByGroupName($group_name,$id_where=[])
    {
        $where = ['name'=>$group_name];
        $menu_group_model = new MenuGroup();
        $rt = $menu_group_model->where($where)->where($id_where)->field('id')->find();
        return $rt ? $rt->id : false;
    }

    /*
     * 获取分组信息
     * @param   $group_id
     */
    public function getMenuGroupNameByGroupId($group_id)
    {
        $menu_group_model = new MenuGroup();
        return $menu_group_model->find($group_id);
    }

    /*
     * 创建分组
     * @param   $data
     */
    public function createMenuGroup($data)
    {
        $date = date('Y-m-d H:i:s');
        $data['created_at'] = $date;
        $data['updated_at'] = $date;
        $menu_group_model = new MenuGroup();
        return $menu_group_model->data($data)->save();
    }

    /*
     * 修改分组
     * @param   $data
     */
    public function updateMenuGroup($data)
    {
        $menu_group_model = new MenuGroup();
        $data['icon']  = $data['icon'] ? $data['icon'] : '&#xe6b1;';
        return $menu_group_model->update($data);
    }

    /*
     * 删除分组
     * @param   $menu_group_id
     */
    public function deleteMenuGroup($menu_group_id)
    {
        $where = [
            'id'    =>  $menu_group_id
        ];
        $menu_group_model = new MenuGroup();
        $menu_service = new MenuService();
        Db::startTrans();
        try {
            $rt = $menu_group_model->where($where)->delete();
            if ($rt) {
                $menu_service->deleteMenuByGroupId($menu_group_id);
            }
            Db::commit();
            return true;
        } catch (\Exception $e) {
            Db::rollback();
        }
        return false;

    }
}