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
Route::get('p',function(){ phpinfo(); });


Route::group(['middleware'=>'checkage','prefix' => 'admin', 'namespace' => 'Admin'], function()
{
  Route::get('/', 'IndexController@index');
  Route::resource('blog', 'BlogController',['except'=>'show']);
  Route::get('blog/cate', 'BlogCateController@index');
  Route::post('blog/cate/re', 'BlogCateController@recovery');
  Route::post('blog/cate/up', 'BlogCateController@update');
  Route::get('blog/{id}/destroy', 'BlogController@destroy')->name('blog.del');
  Route::get('image/path', 'ImageController@path');

});


Route::group(['prefix' => '', 'namespace' => 'Front'], function()
{
  Route::get('/', 'IndexController@index');
  Route::get('blog', 'BlogController@index');
  Route::get('blog/{id}', 'BlogController@show')->where(['id' => '[0-9]+']);
  Route::get('blog/tag={tag}', 'BlogController@findByTag');
  Route::get('blog/{cate}', 'BlogController@index');
});


Route::get('admin/login', 'Admin\AdminController@showLoginForm');
Route::post('admin/login', 'Admin\AdminController@login');
Route::post('admin/logout', ['as' => 'admin.logout', 'uses' => 'Admin\AdminController@logout']);


Route::get('login', 'Auth\LoginController@index');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

Route::get('captcha/{tmp}', 'Auth\LoginController@captcha');
Route::post('login/checkPhrase', 'Auth\LoginController@checkPhrase');
