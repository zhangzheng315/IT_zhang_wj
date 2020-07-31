<?php


namespace app\admin\controller;


use app\common\model\Video;
use app\common\services\video\VideoBase;
use think\Request;

class VideoController extends BaseController
{
    public function index()
    {
        $db=new Video();
        $list= $db->select();
        return view('index',[
            'list'=>$list,
            'i'=>1
        ]);
    }
    public function create(Request $request)
    {
        $input=$request->param();
        $db=new Video();
        if(isset($input['id'])){
            return view('video_create_edit',[
                'video_xg'=>true,
                'id'=>$input['id'],
                'list'=>$db->where('id',$input['id'])->find(),
            ]);
        }else{
            return view('video_create_edit',[
                'video_xg'=>false,
            ]);
        }
    }
    public function save()
    {
        $videoBase=new VideoBase();
        return $videoBase->picture();
    }
    public function forbidden()
    {
        $video_basecontroller=new VideoBase();
        $data=[
            'status'=>input('status')==1 ? 0 : 1,
            'id'=>input('id')
        ];
        return $video_basecontroller->updatestatus($data);
    }
    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id='')
    {
        $db=new Video();
        $biaoji=$db->where('id',$id)->delete();
        return array('status'=>true,'msg'=>'删除成功');
    }
}