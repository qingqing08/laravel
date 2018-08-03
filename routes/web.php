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

Route::get('/a', function () {
    return view('test');
});
/* 增删改查Cms */
Route::get('/mycms' , 'Cms@test');

Route::get('/hello' , 'Cms@index');


Route::get('/userslist' , 'Cms@userlist');
Route::get('/usersadd', 'Cms@useradd');
Route::post('/usersadd_do', 'Cms@useradd_do');
Route::get('/deluser' , 'Cms@userdel');
Route::get('/modifyuser' , 'Cms@updateuser');
Route::post('/usersmodify_do' , 'Cms@usermodify_do');

/*  微站PhoneController */
Route::get('/phone/index' , 'PhoneController@index');
Route::get('/phone/shopcar' , 'PhoneController@shopcar');
Route::get('/phone/self' , 'PhoneController@self');
Route::get('/phone/login' , 'PhoneController@login');
