<?php


namespace app\common\services\images;

use app\common\model\Images;
use app\common\model\Imgcation;
use think\Controller;
use think\Validate;
use think\Db;
class ImagesBase extends Controller
{

    /**
     * 轮播图修改
     * */
    public function picture()
    {
        $date = date('Y-m-d H:i:s');
        if (input('img_xg')=='true'){
            $file = request()->file('image');
            if (true !== $this->validate(['image' => $file], ['image' => 'require|image'], ['image' => 'max:10097152'])) {
                Db::table('wj_Images')->update([
                    'img_id'=>input('img_id'),
                    'img_title'=>input('img_title'),
                    'img_concent'=>input('img_concent'),
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
                    Db::table('wj_Images')->update([
                        'img_url'=>$data,
                        'img_title'=>input('img_title'),
                        'img_concent'=>input('img_concent'),
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
            $db=new Imgcation();
            $text=$db->where('id',input('imgcation'))->value('ifcation_name');
            $file = request()->file('image');
            if (true !== $this->validate(['image' => $file], ['image' => 'require|image'], ['image' => 'max:10097152'])) {
                $this->error('超过2m了');
            } else {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if ($info) {
                    $data = DS . 'uploads' . DS . $info->getSaveName();
                    Db::table('wj_Images')
                        ->data([
                            'ifcation_id'=>input('imgcation'),
                            'img_name'=>$text,
                            'img_url'=>$data,
                            'img_title'=>input('img_title'),
                            'img_concent'=>input( 'img_concent'),
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
        $db=new Images();
        if($db->where('img_id',$data['img_id'])->update([
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