<?php


namespace app\common\services\system;


use app\common\model\System;

class SystemBase
{
    public function updatesystem($data)
    {
        $db=new System();
        if($db->update([
            'name'=>$data['name'],
            'title'=>$data['title'],
            'keyword'=>$data['keyword'],
            'describe'=>$data['describe'],
            'Statistics'=>$data['Statistics'],
            'wx'=>$data['wx'],
            'tel'=>$data['tel'],
            'keeps'=>$data['keeps'],
        ],['id'=>1])==true){
            $data=[
                'status'=>true,
                'msg'=>'修改成功'
            ];
            return $data;
        }else{
            $data=[
                'status'=>false,
                'msg'=>'修改失败'
            ];
            return $data;
        }
    }
}