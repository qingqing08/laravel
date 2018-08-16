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

/* 增删改查Cms */
Route::get('/mycms' , 'Cms@test');

Route::get('/hello' , 'Cms@index');

Route::get('/userslist' , 'Cms@userlist');
Route::get('/usersadd', 'Cms@useradd');
Route::post('/usersadd_do', 'Cms@useradd_do');
Route::get('/deluser' , 'Cms@userdel');
Route::get('/modifyuser' , 'Cms@updateuser');
Route::post('/usersmodify_do' , 'Cms@usermodify_do');

/* 后台登陆 */
Route::get('/home/login' , 'Home\LoginController@login');
Route::post('/home/login_do' , 'Home\LoginController@login_do');

/* 后台首页 */
Route::get('/home/index' , 'home\IndexController@index');
Route::get('/home/welcome' , 'Home\IndexController@welcome');

/* 后台类别管理 */
Route::get('/typeadd' , 'Home\TypeController@typeadd');
Route::post('/typeadd_do' , 'Home\TypeController@typeadd_do');
Route::get('/typelist' , 'Home\TypeController@typelist');

/* 后台商品管理 */
Route::get('goodsadd' , 'Home\GoodsController@goods_add');
Route::any('goodsadd_do' , 'Home\GoodsController@goods_add_do');

/* banner图管理--轮播图 */
Route::get('banneradd' , 'Home\BannerController@banner_add');
Route::post('banneradd_do' , 'Home\BannerController@banner_add_do');
Route::get('bannerlist' , 'Home\BannerController@banner_list');


/* 后台统计日手机订单和电脑订单 */
Route::get('statistics' , 'Home\IndexController@statistics');

/* 后台分析nginx访问日志 */
Route::get('log' , 'Home\IndexController@log');

/*  微站Phone\UserController */
//首页
Route::get('/' , 'Phone\IndexController@index');
Route::get('/detail' , 'Phone\IndexController@detail');
Route::post('/create_cart' , 'Phone\IndexController@create_cart');
//购物车
Route::get('/shopcar' , 'Phone\ShopcarController@shopcar');
Route::post('/buy' , 'Phone\ShopcarController@buy');
Route::get('/buy_view' , 'Phone\ShopcarController@buy_view');
Route::post('up_num' , 'Phone\ShopcarController@up_num');

//订单--支付
Route::get('/alipay/go_pay' , 'Phone\PayController@go_pay');
Route::any('/alipay/notify_url' , 'Phone\PayController@notify_url');
Route::get('/alipay/return_url' , 'Phone\PayController@return_url');
Route::get('/testpay' , 'Phone\ShopcarController@test_pay');
Route::get('recovery' , 'Phone\ShopcarController@recovery');

//退款
Route::get('alipay/refund' , 'Phone\PayController@refund');

//用户中心
Route::get('self' , 'Phone\UserController@self');

//收货地址管理
Route::get('addressadd' , 'Phone\AddressController@add');
Route::get('address' , 'Phone\AddressController@index');
Route::get('addressdetail' , 'Phone\AddressController@detail');
Route::get('addressedit' , 'Phone\AddressController@edit');
Route::post('get_city' , 'Phone\AddressController@city');

//订单列表
Route::get('order' , 'Phone\UserController@order');
//登录
Route::get('login' , 'Phone\UserController@login');
Route::post('login_do' , 'Phone\UserController@login_do');
//重置密码
Route::get('reset_password' , 'Phone\UserController@reset_password');
Route::post('reset_do' , 'Phone\UserController@reset_do');
//退出
Route::get('logout' , 'Phone\UserController@logout');
//注册
Route::get('register' , 'Phone\UserController@register');
Route::post('register_do' , 'Phone\UserController@register_do');
//获取验证码(短信)
Route::post('get_sms' , 'Phone\UserController@get_sms');
//个人详情
Route::get('personal' , 'Phone\UserController@personal');
//分类
Route::get('assort' , 'Phone\AssortController@assort');


//测试-----打卡
Route::get('sign' , 'Phone\SignController@index');
Route::any('sign_do' , 'Phone\SignController@sign');
