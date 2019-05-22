<?php

namespace App\Admin\Controllers;

use App\Firm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Str;

class CheckController extends Controller
{
    //审核视图
    public function firm(){
        $data=Firm::get();
        return view('reg.firm',compact('data'));
    }

    //通过
    public function yes(Request $request){
        $id=$request->id;
        $appID=substr(md5(Str::random(10)),5,15).rand(1111,9999);
        $key=md5($appID);
        $res=Firm::where(['id'=>$id])->update(['status'=>1,'appID'=>$appID,'key'=>$key]);
        if ($res){
            $arr=[
                'errno'=>0,
                'msg'=>'ok'
            ];
            return json_encode($arr);
        }else{
            $arr=[
                'errno'=>50005,
                'msg'=>'Audit failure'
            ];
            return json_encode($arr);
        }
    }

    //驳回
    public function no(Request $request){
        $id=$request->id;
        $res=Firm::where(['id'=>$id])->update(['status'=>3]);
        if ($res){
            $arr=[
                'errno'=>0,
                'msg'=>'reject'
            ];
            return json_encode($arr);
        }else{
            $arr=[
                'errno'=>50005,
                'msg'=>'Audit failure'
            ];
            return json_encode($arr);
        }
    }

}
