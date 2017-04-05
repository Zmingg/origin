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

// 后台 admin
Route::group(['middleware'=>'checkage','prefix' => 'admin', 'namespace' => 'Admin'], function()
{
  Route::get('/', 'IndexController@index');
  Route::resource('blog', 'BlogController',['except'=>'show']);
  Route::resource('blog/cate', 'BlogCateController',['except'=>'show']);
  Route::post('blog/cate/save', 'BlogCateController@aSave');

  Route::get('blog/{id}/destroy', 'BlogController@destroy')->name('blog.del');
  Route::get('image/path', 'ImageController@path');

});

// 前台 front
Route::group(['prefix' => '', 'namespace' => 'Front'], function()
{
  Route::get('/', 'IndexController@index');
  Route::get('blog', 'BlogController@index');
  Route::get('blog/{id}/{title?}', 'BlogController@show')->where(['id' => '[0-9]+']);
  Route::get('blog/{cate}', 'BlogController@index');

  Route::post('blog/pull', 'BlogController@jpull');
});

// 后台登陆组
Route::get('admin/login', 'Admin\AdminController@showLoginForm');
Route::post('admin/login', 'Admin\AdminController@login');
Route::post('admin/logout', ['as' => 'admin.logout', 'uses' => 'Admin\AdminController@logout']);

// 前台登陆组
Route::get('login', 'Auth\LoginController@index');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

// 图片验证码
Route::get('captcha/{tmp}', 'Auth\LoginController@captcha');
Route::post('login/checkPhrase', 'Auth\LoginController@checkPhrase');


// info
Route::get('cv', function(){
  return view('cv');
});

