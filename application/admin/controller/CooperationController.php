<?php


namespace app\admin\controller;
use think\Db;
use app\common\model\Cooperation;
class CooperationController extends BaseController
{
    public function index()
    {
        $db=new Cooperation();
        $list=$db->select();
        return view('index',[
            'list'=>$list,
            'i'=>1
        ]);
    }
    public function delete()
    {
        $db=new Cooperation();
        $biaoji=$db->where('id',input('id'))->delete();
        return array('status'=>true,'msg'=>'删除成功');

    }
    public function create()
    {
        return view('coopreation_create');
    }
    public function save()
    {
        $date = date('Y-m-d H:i:s');
        $file = request()->file('image');
        if (true !== $this->validate(['image' => $file], ['image' => 'require|image'], ['image' => 'max:10097152'])) {
            $this->error('超过2m了');
        } else {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if ($info) {
                $data = DS . 'uploads' . DS . $info->getSaveName();
                Db::table('wj_Cooperation')
                    ->data([
                        'url' => $data,
                        'created_at' => $date,
                        'updated_at' => $date
                    ])->insert();
                return array(
                    'status'=>true,
                    'msg'=>'新增成功'
                );
            } else {
                // 上传失败获取错误信息
                return array(
                    'status'=>true,
                    'msg'=>$file->getError()
                );
            }
        }
    }
}