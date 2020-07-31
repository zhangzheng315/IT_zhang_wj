<?php


namespace app\admin\controller;


use app\common\model\Template;
use think\Db;

class TemplateController extends BaseController
{
    /**
     * 加载模板列表页面
     * */
    public function index()
    {
        $db=new Template();
        $list=$db->select();
        return view('index',[
            'list'=>$list,
            'i'=>1
        ]);
    }
    /**
     * 加载模板新增页面
     * */
    public function create()
    {
        return view('template_edit',[
            'template_xg'=>false
        ]);
    }
    /**
     * 加载模板修改页面
     * */
    public function edit()
    {
        $db=new Template();
        $list=$db->where('id',input('id'))->find();
        return view('template_edit',[
            'list'=>$list,
            'template_xg'=>true
        ]);
    }
    public function update()
    {
        /**
         * 修改前台模板
         * */
        $date = date('Y-m-d H:i:s');
        if (input('template_xg')=='true'){
            $file = request()->file('image');
            if (true !== $this->validate(['image' => $file], ['image' => 'require|image'], ['image' => 'max:10097152'])) {
                Db::table('wj_template')->update([
                    'id'=>input('id'),
                    'section_name'=>input('title'),
                    'section_id'=>input('sid'),
                    'sort'=>input('sort'),
                    'updated_at'=>$date
                ]);
                return array(
                    'status'=>true,
                    'msg'=>'修改成功'
                );
            } else {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static'.DS.'images');
                if ($info) {
                    $name=str_replace("\\","/",$info->getSaveName());
                    $data = '/'.'static' . '/' .'images'.'/'.$name;
                    Db::table('wj_template')->update([
                        'id'=>input('id'),
                        'section_img'=>$data,
                        'section_name'=>input('title'),
                        'section_id'=>input('sid'),
                        'sort'=>input('sort'),
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
             * 模板新增
             * */
        }else{
            $file = request()->file('image');
            if (true !== $this->validate(['image' => $file], ['image' => 'require|image'], ['image' => 'max:10097152'])) {
                $this->error('图片错误');
            } else {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static'.DS.'images');
                if ($info) {
                    $name=str_replace("\\","/",$info->getSaveName());
                    $data = '/'.'static' . '/' .'images'.'/'.$name;
                    Db::table('wj_template')
                        ->data([
                            'section_img'=>$data,
                            'section_name'=>input('title'),
                            'section_id'=>input('sid'),
                            'sort'=>input( 'sort'),
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
     * 更改前台模板状态
     * */
    public function forbidden()
    {
        $data=[
            'status'=>input('status')==1 ? 0 : 1,
            'id'=>input('id')
        ];
        $db=new Template();
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
    /**
     * 删除前台模板
     * */
    public function delete()
    {
        $db=new Template();
        $biaoji=$db->where('id',input('id'))->delete();
        return array('status'=>true,'msg'=>'删除成功');
    }
}