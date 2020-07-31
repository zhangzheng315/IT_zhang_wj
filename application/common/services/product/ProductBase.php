<?php


namespace app\common\services\product;


use app\common\model\Images;
use app\common\model\Imgcation;
use app\common\model\Product;
use think\Controller;
use think\Db;

class ProductBase extends Controller
{
    public function save_article()
    {
        $date = date('Y-m-d H:i:s');
        if (input('article_xg')=='true'){
            $file = request()->file('image');
            if (true !== $this->validate(['image' => $file], ['image' => 'require|image'], ['image' => 'max:10097152'])) {
                Db::table('wj_product')->update([
                    'id'=>input('id'),
                    'title'=>input('title'),
                    'updated_at'=>$date
                ]);
                Db::table('wj_product_content')->where('p_id',input('id'))->update([
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
                    Db::table('wj_product')->update([
                        'id'=>input('id'),
                        'img'=>$data,
                        'title'=>input('title'),
                        'updated_at'=>$date
                    ]);
                    Db::table('wj_product_content')->where('p_id',input('id'))->update([
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
                $this->error('超过2m了');
            } else {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if ($info) {
                    $data = DS . 'uploads' . DS . $info->getSaveName();
                    $id=Db::table('wj_product')->insertGetId([
                        'title'=>input('title'),
                        'img'=>$data,
                        'created_at'=>$date,
                        'updated_at'=>$date
                    ]);
                    Db::table('wj_product_content')
                        ->data([
                            'p_id'=>$id,
                            'content'=>input('content'),
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
        $db=new Product();
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