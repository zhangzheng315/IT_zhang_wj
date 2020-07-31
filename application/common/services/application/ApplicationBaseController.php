<?php


namespace app\common\services\application;


use app\common\model\Application;
use think\Controller;
use think\Db;
class ApplicationBaseController extends Controller
{
    public function picture()
    {
        $date = date('Y-m-d H:i:s');
        if (input('application_xg')=='true'){
            $file = request()->file('image');
            if (true !== $this->validate(['image' => $file], ['image' => 'require|image'], ['image' => 'max:10097152'])) {
                Db::table('wj_application')->update([
                    'id'=>input('id'),
                    'title'=>input('title'),
                    'content'=>input('content'),
                    'updated_at'=>$date
                ]);
                return array(
                    'status'=>true,
                    'msg'=>'修改成功'
                );
            } else {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if ($info) {
                    $data = DS . 'uploads' . DS . $info->getSaveName();
                    Db::table('wj_application')->update([
                        'id'=>input('id'),
                        'image'=>$data,
                        'title'=>input('title'),
                        'content'=>input('content'),
                        'updated_at'=>$date
                    ]);
                    return array(
                      'status'=>true,
                      'msg'=>'修改成功'
                    );
                } else {
                    // 上传失败获取错误信息
                    return array(
                        'status'=>true,
                        'msg'=>$file->getError()
                    );
                }
            }
            /**
             * 轮播图新增
             * */
        }else{
            $file = request()->file('image');
            if (true !== $this->validate(['image' => $file], ['image' => 'require|image'], ['image' => 'max:10097152'])) {
                $this->error('图片错误');
            } else {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if ($info) {
                    $data = DS . 'uploads' . DS . $info->getSaveName();
                    Db::table('wj_application')
                        ->data([
                            'id'=>input('id'),
                            'image'=>$data,
                            'title'=>input('title'),
                            'content'=>input( 'content'),
                            'created_at'=>$date,
                            'updated_at'=>$date
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
    /**
     * 修改广告使用状态
     * */
    public function updatestatus($data)
    {
        $db=new Application();
        if($db->where('id',$data['id'])->update([
                'status'=>$data['status']
            ])==true){
            $data=[
                'status'=>true,
                'msg'=>'更改成功'
            ];
            return $data;
        }else{
            $data=[
                'status'=>false,
                'msg'=>'更改失败'
            ];
            return $data;
        }

    }
}