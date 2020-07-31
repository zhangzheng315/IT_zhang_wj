<?php
namespace app\common\services\message;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use app\common\model\Message;

class MessageService
{
    /*
     * 新增申请信息
     */
    public function selectMessage($where = ['status'=>1])
    {
        $message_model = new Message();
        return $message_model->where($where)->order('status desc')->order('created_at desc')->select();
    }

    /*
     * 创建联系信息
     * @param   $data
     */
    public function createMessage($d)
    {
        $status = 1;
        $message_model = new Message();
        $date = date('Y-m-d H:i:s');
        $data = [
            'name'      =>  $d['name'],
            'username'  =>  $d['username'],
            'phone'     =>  $d['phone'],
            'status'    =>  $status,
            'created_at'=>  $date,
            'updated_at'=>  $date
        ];
        $rt = $message_model->data($data)->save();
        if($rt){
            AlibabaCloud::accessKeyClient('LTAI4Fj3szbuNZ4oKck5izca', 'SrbWKRG8EgT3O9bpUOVbfma1fpnZeY')
                ->regionId('cn-hangzhou')
                ->asDefaultClient();
            try {
                $result = AlibabaCloud::rpc()
                    ->product('Dysmsapi')
                    // ->scheme('https') // https | http
                    ->version('2017-05-25')
                    ->action('SendSms')
                    ->method('POST')
                    ->host('dysmsapi.aliyuncs.com')
                    ->options([
                        'query' => [
                            'RegionId' => "cn-hangzhou",
                            'PhoneNumbers' => '16651704003',
                            'SignName' => "欣奕商务",
                            'TemplateCode' => "SMS_175580256",
                            'TemplateParam' => "{\"code\":".$d['phone']."}",
                        ],
                    ])
                    ->request();
            } catch (ClientException $e) {
                echo $e->getErrorMessage() . PHP_EOL;
            } catch (ServerException $e) {
                echo $e->getErrorMessage() . PHP_EOL;
            }

            session('yzm',null);
            return $rt;
        }
        return false;
    }

    /*
     * 获取申请状态
     * @param   $id
     */
    public function getMessageStatus($id)
    {
        $message_model = new Message();
        $rt = $message_model->where('id',$id)->field('status')->find();
        return $rt ? $rt->status : null;
    }

    /*
     * 修改申请信息状态
     * @param   $mes
     */
    public function updateMessageStatus($id)
    {
        $status = $this->getMessageStatus($id);
        $data = [
            'status'    =>  $status==1 ? 0 : 0,
            'updated_at'=>  date('Y-m-d H:i:s')
        ];
        $message_model = new Message();
        return $message_model->where('id',$id)->update($data);
    }

    /*
     * 删除申请信息
     * @pram    $id
     */
    public function deleteMessage($id)
    {
        $message_model = new Message();
        return $message_model->where('id',$id)->delete();
    }

    /*
    * 获取已处理申请总条数
    */
    public function getMessageOkCount()
    {
        $message_model = new Message();
        $rt = $message_model->where('status',0)->select();
        return count($rt);
    }

    /*
    * 获取已处理申请总条数
    */
    public function getMessageCount()
    {
        $message_model = new Message();
        $rt = $message_model->where('status',1)->select();
        return count($rt);
    }
}
