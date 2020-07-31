<?php
namespace app\common\services\title;

use app\common\model\Title;
use app\common\services\Service;

class TitleService extends Service
{
    public function model()
    {
        // TODO: Implement model() method.
        return Title::class;
    }

    /*
     * 查询
     */
    public function selectTitle()
    {
        return $this->model->find();
    }

    /*
     * 新建大标题
     * @param   $title
     */
    public function createTitle($data)
    {
        $data ['status'] = $this->status;
        $data ['created_at'] = $this->time;
        $data ['updated_at'] = $this->time;

        $rt = $this->model->data($data)->save();
        return $rt ? true : false;
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
     * 获取数据
     * @param   $id
     */
    public function getTitleInfo($id)
    {
        return $this->model->find($id);
    }

    /*
     * 修改
     * @param   $data
     */
    public function updateTitle($data)
    {
        $data['updated_at'] = $this->time;
        $rt = $this->model->update($data);
        return $rt ? true : false;
    }

    /*
     * 删除
     * @param   $id
     */
    public function deleteTitle($id)
    {
        $rt = $this->model->where('id',$id)->delete();
        return $rt ? true : false;
    }
}
