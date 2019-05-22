<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/phpinfo', function () {
    return view('phpinfo');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//企业注册
Route::middleware('auth')->group(function(){
    Route::get('reg','RegController@reg');//注册
    Route::post('regdo','RegController@regdo');//注册执行
});

//接口
Route::get('access_token','ApiController@access_token')->middleware('checknum');//获取access_token
Route::get('test1','ApiController@test1');//测试
Route::get('test2','ApiController@test2');//测试
Route::get('clientip','ApiController@clientip')->middleware(['checkToken','checknum']);//客户端ip
Route::get('clientua','ApiController@clientua')->middleware(['checkToken','checknum']);//客户端User-Agent
Route::get('regInfo','ApiController@regInfo')->middleware(['checkToken','checknum']);//显示注册信息

