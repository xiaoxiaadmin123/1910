<?php

use Illuminate\Support\Facades\Route;

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
//  根目录下的  默认跳转地址  闭包路由
// Route::get('/', function () {
//     return view('welcome');
// });

// // 闭包路由
Route::get('/aa', function () {
	return "这是一个闭包路由";
});

// get方式请求
// 返回视图的两种方式
// 走控制器方法的路由
// Route::get('/index',"IndexController@index");
// 走view
// Route::view("/index","index",['name'=>"小7七"]);

// post 方式请求 -》form表单
 Route::get('/user/add',"IndexController@index");
 Route::post('/user/doadd',"IndexController@doadd")->name('doadd');

//  必填参数
//  1.闭包路由
//  Route::get('/goods/{id}', function ($id) {
// 	return $id;
// });
//  2.view路由   正则约束--》 ?0-1位
// Route::get('/goods/{id}',"IndexController@qi");
// Route::get('/goods/{id}/{name}',"IndexController@goods")->where(['name'=>'[a-zA-Zx(4e00)-\x{9fa5}]{3,7}']);

// 可选参数  加? 必须加初始值
//  1. 闭包路由
//  Route::get('/show/{id?}', function ($id=0) {
// 	return $id;
// });
//   2.view路由
Route::get('/show/{id?}',"IndexController@show");

// 混合参数 ---》  必选参数和可选参数混合使用
Route::get('/hidden/{id}/{name?}',"IndexController@hidden");

// 后台
// 品牌管理  -->路由分组
Route::domain('admin.laravel.com')->group(function(){

    Route::prefix('/brand')->middleware('auth')->group(function(){
        Route::get('/',"Admin\BrandController@index");   //列表展示
        Route::get('create',"Admin\BrandController@create"); //添加页面
        Route::post('store',"Admin\BrandController@store");  //执行添加
        Route::get('edit/{id}',"Admin\BrandController@edit");   //编辑展示
        Route::post('update/{id}',"Admin\BrandController@update");  //执行编辑
        Route::get('destroy/{id}',"Admin\BrandController@destroy");  //执行删除

    });

    // 商品分类 --》路由分组
    Route::prefix('/cate')->middleware('auth')->group(function(){
        Route::get('/',"Admin\CateController@index");   //列表展示
        Route::get('create',"Admin\CateController@create"); //添加页面
        Route::post('store',"Admin\CateController@store");  //执行添加
        Route::get('edit/{id}',"Admin\CateController@edit");   //编辑展示
        Route::post('update/{id}',"Admin\CateController@update");  //执行编辑
        Route::get('destroy/{id}',"Admin\CateController@destroy");  //执行删除

    });

    // 商品管理 --》路由分组
    Route::prefix('/goods')->middleware('auth')->group(function(){
        Route::get('/',"Admin\GoodsController@index");   //列表展示
        // match支持多种请求方式 
        //  Route::match(['get','post'],'/',"Admin\GoodsController@index");   //列表展示
        Route::any('/',"Admin\GoodsController@index");   //列表
        Route::get('create',"Admin\GoodsController@create"); //添加页面
        Route::post('store',"Admin\GoodsController@store");  //执行添加
        Route::get('edit/{id}',"Admin\GoodsController@edit");   //编辑展示
        Route::post('update/{id}',"Admin\GoodsController@update");  //执行编辑
        Route::get('destroy/{id}',"Admin\GoodsController@destroy");  //执行删除

    });

    // 管理员管理 --》路由分组
    Route::prefix('/admin')->middleware('auth')->group(function(){
        Route::get('/',"Admin\AdminController@index");   //列表展示
        Route::get('create',"Admin\AdminController@create"); //添加页面
        Route::post('store',"Admin\AdminController@store");  //执行添加
        Route::get('edit/{id}',"Admin\AdminController@edit");   //编辑展示
        Route::post('update/{id}',"Admin\AdminController@update");  //执行编辑
        Route::get('destroy/{id}',"Admin\AdminController@destroy");  //执行删除
    });

    // 友情链接管理 --》路由分组
    Route::prefix('/hotlink')->group(function(){
        Route::get('/',"Admin\HotlinkController@index");   //列表展示
        Route::get('create',"Admin\HotlinkController@create"); //添加页面
        Route::post('store',"Admin\HotlinkController@store");  //执行添加
        Route::get('edit/{id}',"Admin\HotlinkController@edit");   //编辑展示
        Route::post('update/{id}',"Admin\HotlinkController@update");  //执行编辑
        Route::get('destroy/{id}',"Admin\HotlinkController@destroy");  //执行删除
    });

    Route::view('/login','admin.login');
    Route::post('/loginDo','Admin\LoginController@logindo');

    // cookie应用
    Route::get('/setcookie','IndexController@setcookie'); //设置cookie
    Route::get('/getcookie','IndexController@getcookie'); //设置cooki

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
});

// 前台
Route::domain('www.laravel.com')->group(function(){
    Route::get('/','Index\IndexController@index')->name('shop.index');
    Route::get('/login','Index\LoginController@login');
    Route::get('/reg','Index\LoginController@reg');
    Route::post('/logindo','Index\LoginController@logindo');
    // 手机号发送验证码
    Route::post('/sendSms','Index\LoginController@sendSms');
    Route::get('/sendEmail','Index\LoginController@sendEmail');

    Route::get('/goods/{id}','Index\GoodsController@index')->name('shop.goods');
    Route::get('/addcar','Index\GoodsController@addcar');
    
    Route::get('/cartlist','Index\CartController@cartlist')->name('shop.cartlist');


});

