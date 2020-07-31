<?php


namespace app\admin\controller;
use app\common\model\Product;
use app\common\services\product\ProductBase;
use think\Db;
use think\Request;

class SystemArticleController extends BaseController
{
    /**
     * 系统介绍管理
     * */
    public function index()
    {
        $db=new Product();
        return view('index',[
            'list'=>$db->select(),
            'i'=> 1
        ]);
    }
    /**
     * 新增系统介绍
     * */
    public function save()
    {
        $base=new ProductBase();
       return $base->save_article();
    }
    /**
     * 渲染系统模板
     * */
    public function create(Request $request)
    {
        $input=$request->param();
        $db=new Product();
        if(isset($input['id'])){
            return view('productCreateEdit',[
                'article_xg'=>true,
                'id'=>$input['id'],
                'list'=>$db->where('id',$input['id'])->find(),
                'conctent'=>Db::table('wj_product_content')->where('p_id',$input['id'])->value('content')
            ]);
        }else{
            return view('productCreateEdit',[
                'article_xg'=>false,
            ]);
        }
    }
    /**
     * 更改系统模板状态
     * */
    public function forbidden()
    {
        $Product_basecontroller=new ProductBase();
        $data=[
            'status'=>input('status')==1 ? 0 : 1,
            'id'=>input('id')
        ];
        return $Product_basecontroller->updatestatus($data);
    }
    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id='')
    {
        $db=new Product();
        $biaoji=$db->where('id',$id)->delete();
        return array('status'=>true,'msg'=>'删除成功');
    }
}