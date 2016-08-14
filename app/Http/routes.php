<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('user/{id}', function ($id) {
//    //return view('welcome');
//    return 'user '.$id;
//});
//Route::get('/', function (){
//   return view('welcome');
//});
//Route::get('test1', function (){
//    return view('greeting', ['name' => 'James']);
//});
//
//Route::auth();
//
//Route::get('/home', 'HomeController@index');
//
//Route::get('/bindwx', 'BindController@getindex');
//Route::post('/bindwx', 'BindController@postindex');

//用户相关路由
//验证路由
Route::auth();


//图片接口引擎

Route::group(['middleware'=>['web'], 'prefix' => 'img'],function(){
    Route::get('/{imgId}', 'Image\imageController@getMain');//获取上传的图片
    Route::get('qrcode/{cmd}', 'Image\imageController@getQrcode');//获取二维码
    Route::post('upload','Image\imageController@postupload');//上传文件(暂未完成）
});
//用户信息页面
Route::group(['middleware'=>['web'],'prefix'=>'user'],function(){
    Route::get('/', 'User\UserController@getindex');//用户主页
    Route::get('live', 'User\UserController@getlive');//直播间页面，如果没有开通直播则是直播开通页面
    Route::post('/edit', 'User\UserController@postEditinfo');//修改用户信息
    Route::get('/bindwx', 'User\UserController@getBindwx');//接收微信服务器的消息
    Route::post('/bindwx/submit', 'User\UserController@postWxsubmit');//确定绑定信息
    Route::post('/newlive', 'User\UserController@postNewlive');//开通直播间
    Route::get('/livec/{c}', 'User\UserController@getLiveControl');//直播控制，c=start开始直播，c=stop停止直播
});

//主页面
Route::get('/','Live\LiveController@getindex');