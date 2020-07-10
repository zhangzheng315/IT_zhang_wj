<?php

use think\migration\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = $this->getData();
        $date = date('Y-m-d H:i:s');
        foreach ($data as $item) {
            $menu_model = new \app\common\model\Menu();
            $menu_model->pid = $item['pid'];
            $menu_model->name = $item['name'];
            $menu_model->url = $item['url'];
            $menu_model->sort = $item['sort'];
            $menu_model->created_at = $date;
            $menu_model->updated_at = $date;
            $menu_model->save();
        }
    }

    public function getData()
    {
        $data = [
            [
                'pid'   =>  1,
                'name'  =>  '用户列表',
                'url'   =>  'user/index',
                'sort'  =>  1,
            ],
            [
                'pid'   =>  1,
                'name'  =>  '用户新增',
                'url'   =>  'user/create',
                'sort'  =>  2,
            ],
            [
                'pid'   =>  1,
                'name'  =>  '等级管理',
                'url'   =>  'javascript:;',
                'sort'  =>  3,
            ],
            [
                'pid'   =>  2,
                'name'  =>  'banner列表',
                'url'   =>  'images/index',
                'sort'  =>  1,
            ],
            [
                'pid'   =>  3,
                'name'  =>  '菜单列表',
                'url'   =>  'menu/index',
                'sort'  =>  1,
            ],
            [
                'pid'   =>  3,
                'name'  =>  '菜单新增',
                'url'   =>  'menu/create',
                'sort'  =>  1,
            ],
        ];
        return $data;
    }
}