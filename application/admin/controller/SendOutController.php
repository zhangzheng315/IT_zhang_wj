<?php


namespace app\admin\controller;


use app\common\services\message\MessageService;
use think\Controller;
use think\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

class SendOutController extends BaseController
{
    //发送短信验证码
    public function index(Request $request)
    {
        $yzm=mt_rand('111111','999999');
        session('yzm',$yzm);
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
                        'PhoneNumbers' => input('tel'),
                        'SignName' => "欣奕商务",
                        'TemplateCode' => "SMS_175580256",
                        'TemplateParam' => "{\"code\":".$yzm."}",
                    ],
                ])
                ->request();
            print_r($result->toArray());
        } catch (ClientException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
        }
    }
    public function verification(Request $request)
    {
        $input = $request->param();
        if(session('yzm')!=input('yzm')){
            return array(
                'status'=>false,
                'msg'=>'验证码错误'
            );
        }else{
            $message_service = new MessageService();
            $rt = $message_service->createMessage($input);
            return $rt ?
                ['status'=>true,'msg'=>'申请成功'] :
                ['status'=>false,'msg'=>'申请失败'];
        }
    }
}