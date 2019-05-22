<?php

namespace App\Http\Controllers;

use const http\Client\Curl\Versions\IDN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;
use App\Firm;
class RegController extends Controller
{
    //注册
    public function reg()
    {
        return view('reg.reg');
    }

    //注册执行
    public function regdo(Request $request)
    {
        $uid=Auth::id();
        $data = $request->all();
        unset($data['_token']);
        if (empty($data['name']) ?? '' || empty($data['legal_per']) || empty($data['taxno']) ?? '' || empty($data['publicno']) || empty($data['license'])) {
            $arr = [
                'errno' => 50001,
                'msg' => '注册信息不完整'
            ];
            return json_encode($arr);
        }
        $name = Firm::where(['name' => $data['name']])->first();
        if ($name) {
            $arr = [
                'errno' => 50002,
                'msg' => '企业名称已注册'
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }
        $firmonly=Firm::where('uid',$uid)->first();
        if($firmonly){
            $response=[
                'errno'=>'50321',
                'msg'=>'您已经有一个企业了'
            ];
            return json_encode($response,JSON_UNESCAPED_UNICODE);
        }
        $data['license'] = $this->upload($request, 'license');
        $data['uid']=$uid;
        $res = Firm::insertGetId($data);
        if ($res) {
            echo "<script>alert('注册成功，审核中...');location.href='/admin/firm';</script>";
        }
    }

    //上传图片
    public function upload(Request $request, $filename)
    {
        if ($request->hasFile($filename) && $request->file($filename)->isValid()) {
            $photo = $request->file($filename);
            $extension = $photo->extension();
            $filename = substr((time() . Str::random(15)), 3, 18) . '.' . $extension;
            $file_path = 'uploads/' . date('Ymd');
            $store_result = $photo->storeAs($file_path, $filename);
            return $store_result;
            exit;
        }
        exit('未获取到上传文件或上传过程出错');
    }

}
