<?php

namespace app\admin\controller;

//use app\common\service\images\imagesBase;

use app\common\model\Images;
use app\common\model\Imgcation;
use app\common\services\images\ImagesBase;
use think\Controller;
use think\Request;
class ImagesController extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
        $input = $request->param();
        $db=new Imgcation();
        $map['ifcation_id'] = ['like','%'.input('ifcation_id').'%'];
        $list = Images::order('img_id', 'asc')->where($map)->paginate('10', false,['query'=>request()->param()]);
        $page=$list->render();
        $this->assign('list', $list);
        $this->assign('ps',$db->select());
        $this->assign('page',$page);
        $i = 1;
//        $page = $input['page'];
        return $this->fetch('images',compact('i'));
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $db=new Imgcation();
        $list=$db->select();
        return view('images_create',[
            'list'=>$list
        ]);
    }

    /**
     * 保存新建的资源
     * 新闻增加
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
       $db=new \app\common\services\images\ImagesBase();
       return $db->picture();
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($img_id='')
    {
        //

        $db=new Images();
        $list=$db->where('img_id',$img_id)->select();
        return view('images_edit',[
            'list'=>$list
        ]);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 更改广告使用状态
     * */
    public function forbidden()
    {
        $img_basecontroller=new ImagesBase();
        $data=[
            'status'=>input('status')==1 ? 0 : 1,
            'img_id'=>input('img_id')
        ];
        return $img_basecontroller->updatestatus($data);
    }
    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($img_id='')
    {
        $db=new Images();
        $biaoji=$db->where('img_id',$img_id)->delete();
        return array('status'=>true,'msg'=>'删除成功');
    }
}
