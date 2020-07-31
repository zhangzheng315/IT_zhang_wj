<?php


namespace app\common\services\index;



use app\common\model\Application;
use app\common\model\Casese;
use app\common\model\Cooperation;
use app\common\model\Images;
use app\common\model\LittleTitle;
use app\common\model\Product;
use app\common\model\System;
use app\common\model\Template;
use app\common\model\Title;
use app\common\model\Video;
use app\common\services\company\CompanyService;
use think\Controller;

class IndexBaseController extends Controller
{
    protected $list;
    protected $systemmodel;
    protected $product;
    protected $application;
    protected $Cooperation;
    protected $videos;
    protected $arr;
    protected $caseses;
    protected $title;
    protected $l_lists;

    public function _initialize()
    {
        // 获取企业信息
        $company_service = new CompanyService();
        $c_lists = $company_service->selectCompany();
        /*轮播图获取*/
        $ix=new Images();
        $map['status']=['like','%'.'1'.'%'];
        $map['ifcation_id']=['like','%'.'1'.'%'];
        $this->list=$ix->where($map)->select();
        /*系统设置获取*/
        $this->systemmodel=new System();
        /*产品介绍获取*/
        $db=new Product();
        $map1['status']=['like','%'.'1'.'%'];
        $this->product=$db->where($map1)->select();
        /*应用领域*/
        $application=new Application();
        $map2['status']=['like','%'.'1'.'%'];
        $this->application=$application->where($map2)->select();
        /*合作伙伴*/
        $Cooperation=new Cooperation();
        $this->Cooperation=$Cooperation->select();
        /*视频展示*/
        $video=new Video();
        $this->videos=$video->select();
        /*案例展示*/
        $casese = new Casese();
        $this->caseses = $casese->where('status',1)->select();
        /*排序数据*/
        $tj=new Template();
        $map3['status']=['like','%'.'1'.'%'];
        $this->arr=$tj->where($map3)->order('sort','asc')->field('section_id,section_name,section_img')->select();
        /*获取title*/
        $title = new Title();
        $re = $title->where('status',1)->field('title')->find();
        $this->title = $re ? $re->title : '';
        /*获取小标题*/
        $little_title = new LittleTitle();
        $l_lists = $little_title->where('status',1)->select();
        $this->l_lists = $l_lists;

        $this->assign('arr',$this->arr);
        $this->assign('videos',$this->videos);
        $this->assign('Cooperation',$this->Cooperation);
        $this->assign('x',1);
        $this->assign('list',$this->list);
        $this->assign('page',count($this->list));
        $this->assign('system',$this->systemmodel->find());
        $this->assign('product',$this->product);
        $this->assign('c_list',$c_lists);
        $this->assign('application',$this->application);
        $this->assign('caseses',$this->caseses);
        $this->assign('title',$this->title);
        $this->assign('l_lists',$this->l_lists);
    }
}