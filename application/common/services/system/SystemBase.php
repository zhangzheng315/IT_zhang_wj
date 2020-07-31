<?php


namespace app\common\services\system;


use app\common\model\Imgcation;
use app\common\model\System;
use think\Controller;
use think\Db;
use think\Validate;
class SystemBase extends Controller
{
    public function updatesystem()
    {
        $file = request()->file('image');
        if(isset($file)){
            if (true !== $this->validate(['image' => $file], ['image' => 'require|image'], ['image' => 'max:10097152'])) {
                $this->error('超过2m了');
            } else {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if ($info) {
                    $data = DS . 'uploads' . DS . $info->getSaveName();
                    $db = new System();
                    if ($db->update([
                            'logo' => $data,
                            'title' => input('system_title'),
                            'keyword' => input('system_guan'),
                            'describe' => input('system_miaoshu'),
                            'Statistics' => input('system_daima'),
                            'wx' => input('system_wx'),
                            'tel' => input('system_tel'),
                            'keeps' => input('system_beian'),
                        ], ['id' => 1]) == true) {
                        return ['status'=>true,'msg'=>'修改成功'];
                    } else {
                        return ['status'=>false,'msg'=>'修改失败'];
                    }
                }else {
                    return ['status'=>false,'msg'=>$file->getError()];
                }
            }
        }else {
            $db = new System();
            if ($db->update([
                    'title' => input('system_title'),
                    'keyword' => input('system_guan'),
                    'describe' => input('system_miaoshu'),
                    'Statistics' => input('system_daima'),
                    'wx' => input('system_wx'),
                    'tel' => input('system_tel'),
                    'keeps' => input('system_beian'),
                ], ['id' => 1]) == true) {
                return ['status'=>true,'msg'=>'修改成功'];
            } else {

                return ['status'=>false,'msg'=>'修改失败'];
            }
        }
    }
}