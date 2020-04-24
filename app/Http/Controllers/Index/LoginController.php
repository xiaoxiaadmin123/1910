<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCode;
use App\User;
use App\Member;
class LoginController extends Controller
{
    // 登录
   public function login(){

       return view('index.login');
   }


   public function logindo(){
       $post = request()->except('_token','/logindo');
    //    dd($post);s

    $user = Member::where('username',$post['username'])->first();
    // dump(encrypt('123456'));
    // dd(encrypt('123456'));
    // dd(decrypt($adminuser->admin_pwd));
    if(decrypt($user->pwd)!=$post['pwd']){
        return redirect('/login')->with('msg','用户名或密码不对');
    }

    session(['member'=>$user]);
    // 判断refer知否有值
    if($post['refer']){
        return redirect($post['refer']);
    }
    return redirect('/');




    }

//    注册
   public function reg(){
       
    return view('index.reg');
    }

    public function index(){
        echo 111;die;
        $user =  User::save();
        dd($user);
        return view('index.index');
    }

  
   public function sendSms(Request $request){
        $mobile = $request->mobile;
        // php验证手机号
        $reg = '/^1[3|5|6|7|8|9]\d{9}$/';
        // dd($reg);
        if(!preg_match($reg,$mobile)){
            echo json_encode(['code'=>'00000','msg'=>"手机号格式不对"]);die;
        }
        
        $code = rand(100000,999999);
        // 发送
        $res = $this->sendByMobile($mobile,$code);
        if($res['Message']=='OK'){
            session(['code'=>$code]);
            echo json_encode(['code'=>'00000','msg'=>"发送成功"]);die;
        }

    }

    public function sendByMobile($mobile,$code){          
            // Download：https://github.com/aliyun/openapi-sdk-php
            // Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

            AlibabaCloud::accessKeyClient('LTAI4GFfT5ApepWig7khtExS', 'KkbL689MJqs8kCxgncG8ie5PufKtyG')
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
                                                    'PhoneNumbers' => $mobile,
                                                    'SignName' => "开心笑麻花",
                                                    'TemplateCode' => "SMS_185211969",
                                                    'TemplateParam' => "{code:$code}",
                                                    ],
                                                ])
                                    ->request();
                return $result->toArray();
            } catch (ClientException $e) {
                return $e->getErrorMessage() . PHP_EOL;
            } catch (ServerException $e) {
                return $e->getErrorMessage() . PHP_EOL;
            }


    }
   
    // 验证邮箱
    public  function sendEmail(Request $request){
        $email = $request->email;
        // dd($email);
        // php验证手机号
        $reg = '/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/';
        // dd(preg_match($reg,$email));
        if(!preg_match($reg,$email)){
            echo json_encode(['code'=>'00001','msg'=>"邮箱格式不对"]);die;
        }
        
        $code = rand(100000,999999);

        // 掉用邮箱发送验证码
        $this->sendByEmail($email,$code);
        session(['code'=>$code]);
        echo json_encode(['code'=>'00000','msg'=>"发送成功"]);die;
    }

 // 使用laravel框架发送邮箱
    public function sendByEmail($email,$code){
        Mail::to($email)->send(new SendCode($code));

    }


}
