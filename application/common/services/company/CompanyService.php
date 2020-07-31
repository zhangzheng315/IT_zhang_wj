<?php
namespace app\common\services\company;


use app\common\model\Company;
use app\common\services\Service;

class CompanyService extends Service
{
    public function model()
    {
        // TODO: Implement model() method.
        return Company::class;
    }

    /*
     * 创建企业信息
     * @param   $data
     */
    public function createCompany($data,$file=null)
    {
        $icon = isset($file['icon']) ? $file['icon'] : null;
        $wx = isset($file['wx']) ? $file['wx'] : null;
        $gzh = isset($file['gzh']) ? $file['gzh'] : null;
        $video = isset($file['video']) ? $file['video'] : null;

        //企业icon
        if ($icon) {
            $info = $icon->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . 'icon' , '');

            if ($info) {
                $url = DS . 'uploads' . DS . 'icon' . DS . $info->getSaveName();
                $data['icon'] = $url;
            }
        }

        //企业微信号
        if ($wx) {
            $info = $wx->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . 'wx');

            if ($info) {
                $url = DS . 'uploads' . DS . 'wx' . DS . $info->getSaveName();
                $data['wx'] = $url;
            }
        }

        //企业微信公众号
        if ($gzh) {
            $info = $gzh->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . 'gzh');

            if ($info) {
                $url = DS . 'uploads' . DS . 'gzh' . DS . $info->getSaveName();
                $data['gzh'] = $url;
            }
        }

        //企业宣传视频
        if ($video) {
            $info = $video->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . 'prop','');

            if ($info) {
                $url = DS . 'uploads' . DS . 'prop' . DS . $info->getSaveName();
                $data['video'] = $url;
            }
        }

        $data['created_at'] = $this->time;
        $data['updated_at'] = $this->time;
        $rt = $this->model->data($data)->save();
        return $rt ? true : false;
    }

    /*
     * 查看企业信息
     */
    public function selectCompany()
    {
        return $this->model->find();
    }

    /*
     * 修改企业信息
     * @param   $data
     */
    public function updateCompany($data , $file=null)
    {
        $icon = isset($file['icon']) ? $file['icon'] : null;
        $wx = isset($file['wx']) ? $file['wx'] : null;
        $gzh = isset($file['gzh']) ? $file['gzh'] : null;
        $video = isset($file['video']) ? $file['video'] : null;
        //企业icon
        if ($icon) {
            $info = $icon->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . 'icon' , '');

            if ($info) {
                $url = DS . 'uploads' . DS . 'icon' . DS . $info->getSaveName();
                $data['icon'] = $url;
            }
        }

        //企业微信号
        if ($wx) {
            $info = $wx->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . 'wx');

            if ($info) {
                $url = DS . 'uploads' . DS . 'wx' . DS . $info->getSaveName();
                $data['wx'] = $url;
            }
        }

        //企业微信公众号
        if ($gzh) {
            $info = $gzh->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . 'gzh');

            if ($info) {
                $url = DS . 'uploads' . DS . 'gzh' . DS . $info->getSaveName();
                $data['gzh'] = $url;
            }
        }

        //企业宣传视频
        if ($video) {
            $info = $video->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . 'prop','');

            if ($info) {
                $url = DS . 'uploads' . DS . 'prop' . DS . $info->getSaveName();
                $data['video'] = $url;
            }
        }
        $where = ['id'=>1];
        $data['updated_at'] = $this->time;
        $rt = $this->model->where($where)->update($data);
        return $rt ? true : false;
    }
}