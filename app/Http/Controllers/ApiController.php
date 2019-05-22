<?php

namespace App\Http\Controllers;

use App\Firm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    //生成access_token
    public function access_token()
    {
        $appID = $_GET['appID'];
        $key = $_GET['key'];
        if (empty($appID) || empty($key)) {
            $arr = [
                'errno' => 0,
                'msg' => '参数不完整'
            ];
            die(json_encode($arr, JSON_UNESCAPED_UNICODE));
        }
        $data = Firm::where(['appID' => $appID, 'key' => $key])->first();
//        print_r($data);die;
        if (!$data) {
            $arr = [
                'errno' => 50006,
                'msg' => '参数错误'
            ];
            die(json_encode($arr, JSON_UNESCAPED_UNICODE));
        }
        $token = substr(md5($appID . $key), 5, 18);
        $keys = 's:token';
        Redis::Sadd($keys, $token);
        $response = [
            'errno' => 0,
            'access_token' => $token
        ];
        return json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    //测试
//    public function test1()
//    {
////        $url='http://vmw.1809api.com/clientip?server='.$server;
//        $key = 'access_token';
//        if (Redis::get($key)) {
//            $response = [
//                'errno' => 0,
//                'access_token' => Redis::get($key)
//            ];
//            return json_encode($response, JSON_UNESCAPED_UNICODE);
//        } else {
//            $url = 'http://vmw.1809api.com/access_token?appID=76abc98304fabcc5342&key=ca6478a1f8433e5c6c10f1f7debe8d52';
////        dd($url);
//            $ch = curl_init($url);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            $response = curl_exec($ch);
//            curl_close($ch);
//            $data = json_decode($response, true);
//            Redis::set($key, $data['access_token']);
//            Redis::expire($key, 3600);
//            $response = [
//                'errno' => 0,
//                'access_token' => $data['access_token']
//            ];
//            return json_encode($response, JSON_UNESCAPED_UNICODE);
//        }
//
//    }

    public function test1(){
        $url='http://vmw.1809api.com/access_token?appID=adf0eac94178db88360&key=e85efda8014c17d3c9d9fd6cf155213e';
        $ch=curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $response=curl_exec($ch);
        echo $response;
        curl_close($ch);
    }

    //显示客户端IP
    public function clientip()
    {
        $ip = $_SERVER['SERVER_ADDR'];
        if (empty($ip)) {
            $arr = [
                'errno' => 50001,
                'msg' => '参数不完整'
            ];
            die(json_encode($arr, JSON_UNESCAPED_UNICODE));
        } else {
            $arr = [
                'errno' => 0,
                'ip' => $ip
            ];
            die(json_encode($arr, JSON_UNESCAPED_UNICODE));
        }
    }

    //测试2
    public function test2(){
        $url='http://vmw.1809api.com/regInfo?appID=adf0eac94178db88360&key=e85efda8014c17d3c9d9fd6cf155213e&access_token=9e35e17e29e49de5f8';
        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response=curl_exec($ch);
        echo $response;
        curl_close($ch);
    }

    //显示客户端UA
    public function clientua(){
        $ua = $_SERVER['HTTP_USER_AGENT'];
//        print_r($ua);
        if (empty($ua)) {
            $arr = [
                'errno' => 50001,
                'msg' => '参数不完整'
            ];
            die(json_encode($arr, JSON_UNESCAPED_UNICODE));
        } else {
            $arr = [
                'errno' => 0,
                'User-Agent' => $ua
            ];
            die(json_encode($arr, JSON_UNESCAPED_UNICODE));
        }
    }

    //显示用户注册信息
    public function regInfo(){
        $appID=$_GET['appID']??'';
        $key=$_GET['key']??'';
        if(empty($appID)){
            $response=[
                'errno'=>'51000',
                'msg'=>'缺少appID'
            ];
            die(json_encode($response,JSON_UNESCAPED_UNICODE));
        }else if(empty($key)){
            $response=[
                'errno'=>'51000',
                'msg'=>'缺少key'
            ];
            die(json_encode($response,JSON_UNESCAPED_UNICODE));
        }
        $data=Firm::where(['appID'=>$appID,'key'=>$key])->first();
        if(!$data){
            $response=[
                'errno'=>'51000',
                'msg'=>'appID或key错误'
            ];
            return json_encode($response,JSON_UNESCAPED_UNICODE);die;
        }else{
            $response=[
                'errno'=>'0',
                'data'=>json_encode($data,JSON_UNESCAPED_UNICODE)
            ];
            return json_encode($response,JSON_UNESCAPED_UNICODE);die;
        }
    }
    
}
