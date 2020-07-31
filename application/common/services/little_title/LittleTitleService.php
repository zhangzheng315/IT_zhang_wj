<?php
namespace app\common\services\little_title;

use app\common\model\LittleTitle;
use app\common\services\Service;

class LittleTitleService extends Service
{
    public function model()
    {
        // TODO: Implement model() method.
        return LittleTitle::class;
    }

    /*
     * 查询
     */
    public function selectLittleTitle($where)
    {
        $rt = $this->model->where($where)->select();
        return $rt ? $rt : null;
    }

    /*
     * 查询单条
     * @param   $id
     */
    public function findLittleTitle($id)
    {
        return $this->model->find($id);
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
     * 更改状态
     * @param   $data
     */
    public function updateStatus($data)
    {
        $rt = $this->model->update($data);
        return $rt ? true : false ;
    }

    /*
     * 新增
     * @param   $data
     */
    public function createLittleTitle($data)
    {
        $data['status'] = $this->status;
        $data['created_at'] = $this->time;
        $data['updated_at'] = $this->time;

        $rt = $this->model->data($data)->save();
        return $rt ? true :false;
    }

    /*
     * 编辑
     * @param   $data
     */
    public function updateLittleTitle($data)
    {
        $data['updated_at'] = $this->time;

        $rt = $this->model->update($data);
        return $rt ? true :false;
    }

    /*
     * 删除
     * @param   $id
     */
    public function deleteLittleTitle($id)
    {
        $where = [
            'id'    =>  $id
        ];
       
        return $this->model->where($where)->delete();
    }
}