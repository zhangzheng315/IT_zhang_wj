<?php
namespace app\common\services\casese;

use app\common\model\Casese;
use app\common\services\Service;

class CaseseService extends Service
{
    public function model()
    {
        // TODO: Implement model() method.
        return Casese::class;
    }

    /*
     * 获取单条状态
     * @param   $id
     */
    public function getStatusById($id)
    {
        $where = [
            'id'    =>  $id
        ];

        $rt = $this->model->where($where)->field('status')->find();
        return $rt ? $rt->status : null;
    }

    /*
     * 更改案例状态
     * @param   $data
     */
    public function updateStatus($data)
    {
        $rt = $this->model->update($data);
        return $rt ? true : false ;
    }

    /*
     * 获取案例
     */
    public function selectCase()
    {
        return $this->model->select();
    }

    /*
     * 获取单条案例
     * @param   $id
     */
    public function getCase($id)
    {
        return $this->model->find($id);
    }

    /*
     * 创建案例信息
     * @param   $data $file
     */
    public function createCase($data,$file)
    {
        $status = 1;
        $image = isset($file['image']) ? $file['image'] : null;
        if ($image) {
            $info = $image->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . 'wx');

            if ($info) {
                $url = DS . 'uploads' . DS . 'wx' . DS . $info->getSaveName();
                $data['case_img'] = $url;
            }
        }
        $data['status'] = $this->status;
        $data['created_at'] = $this->time;
        $data['updated_at'] = $this->time;
        $rt = $this->model->data($data)->save();
        return $rt ? true : false;
    }

    /*
     * 修改案例信息
     * @param   $data $file
     */
    public function updateCase($data, $file)
    {
        $image = isset($file['image']) ? $file['image'] : null;
        if ($image) {
            $info = $image->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . 'wx');

            if ($info) {
                $url = DS . 'uploads' . DS . 'wx' . DS . $info->getSaveName();
                $data['case_img'] = $url;
            }
        }

        $data['updated_at'] = $this->time;
        $rt = $this->model->update($data);
        return $rt ? true : false;
    }

    /*
     * 删除案例
     * @param   $id
     */
    public function deleteCase($id)
    {
        $rt = $this->model->where('id',$id)->delete();
        return $rt ? true : false;
    }
}
