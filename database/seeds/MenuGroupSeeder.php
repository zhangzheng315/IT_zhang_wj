<?php

use think\migration\Seeder;

class MenuGroupSeeder extends Seeder
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
            $menu_group_model = new \app\common\model\MenuGroup();
            $menu_group_model->id = $item['id'];
            $menu_group_model->name = $item['name'];
            $menu_group_model->icon = $item['icon'];
            $menu_group_model->sort = $item['sort'];
            $menu_group_model->created_at = $date;
            $menu_group_model->updated_at = $date;
            $menu_group_model->save();
        }
    }

    public function getData()
    {
        $data = [
            [
                'id'    =>  1,
                'name'  =>  '用户管理',
                'icon'  =>  '&#xe66f;',
                'sort'  =>  1,
            ],
            [
                'id'    =>  2,
                'name'  =>  '图片管理',
                'icon'  =>  '&#xe64a;',
                'sort'  =>  2,
            ],
            [
                'id'    =>  3,
                'name'  =>  '菜单管理',
                'icon'  =>  '&#xe648;',
                'sort'  =>  3,
            ],
        ];
        return $data;
    }
}