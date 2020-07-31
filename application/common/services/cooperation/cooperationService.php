<?php
namespace app\common\services\cooperation;

use app\common\model\Cooperation;

class cooperationService
{
    /*
     * 获取合作伙伴总条数
     */
    public function getCooperationCount()
    {
        $cooperation_model = new Cooperation();
        $rt = $cooperation_model->select();
        return count($rt);
    }
}
