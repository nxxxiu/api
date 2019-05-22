<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;
class Checknum
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        dd($_SERVER);
        $key=$_SERVER['REMOTE_ADDR'].$_SERVER['REQUEST_URI'];
        $num=Redis::Incr($key);
//        print_r($num);die;
        Redis::expire($key,60);
        if ($num>=20){
            $arr=[
                'errno'=>50010,
                'msg'=>'访问次数达到上限'
            ];
            die(json_encode($arr,JSON_UNESCAPED_UNICODE));
        }

        return $next($request);
    }
}
