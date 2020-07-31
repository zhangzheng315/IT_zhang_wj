<?php

namespace app\admin\controller;

use app\common\services\company\CompanyService;
use think\Request;
use think\Validate;

class CompanyController extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $company_service = new CompanyService();
        $info = $company_service->selectCompany();
        if($info){
            $lists = [
                '企业图标'      =>  $info['icon'] ? '<img width="50px" src="'.$info['icon'].'">' : '',
                '企业微信号'      =>  $info['wx'] ? '<img width="50px" src="'.$info['wx'].'">' : '',
                '企业微信公众号'      =>  $info['gzh'] ? '<img width="50px" src="'.$info['gzh'].'">' : '',
                '企业名称'      =>  $info['name'] ? $info['name'] : '',
                '企业英文名称'    =>  $info['english'] ? $info['english'] : '',
                '企业联系电话'    =>  $info['tel'] ? $info['tel'] : '',
                '企业QQ'          =>  $info['qq'] ? $info['qq'] : '',
                '企业地址'      =>  $info['address'] ? $info['address'] : '',
                '企业邮箱'      =>  $info['email'] ? $info['email'] : '',
                '企业描述'      =>  $info['descrip'] ? $info['descrip'] : '',
            ];
        }else{
            $lists=[];
        }

        return $this->fetch('index',compact('lists','info'));
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $title = '新增';
        $button = 'add';
        return $this->fetch('createOrEdit',compact('title','button'));
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $input = $request->param();

        $file = $request->file();

        $company_service = new CompanyService();
        $rt = $company_service->createCompany($input,$file);
        return $rt ?
            ['status'=>true,'msg'=>'新增成功'] :
            ['status'=>false,'msg'=>'新增失败'];
    }

    /*
     * 获取英文
     * @param   $word
     */
    public function getEnglish($word)
    {
        $url = 'http://fanyi.youdao.com/translate?&doctype=json&type=ZH_CN2EN&i='.$word;
        $rt = file_get_contents($url);
        return $rt;
//        return json_encode(file_get_contents($url));
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read()
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit()
    {
        $company_service = new CompanyService();
        $info = $company_service->selectCompany();
        $title = '编辑';
        $button = 'update';
        return $this->fetch('createOrEdit',compact('title','button','info'));
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request)
    {
        $input = $request->param();

        $file = $request->file();

        $company_service = new CompanyService();
        $rt = $company_service->updateCompany($input,$file);
        return $rt ?
            ['status'=>true,'msg'=>'修改成功'] :
            ['status'=>false,'msg'=>'修改失败'];
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
