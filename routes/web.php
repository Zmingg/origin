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
  Route::get('image/path', 'ImageController@path'); //缩略图预览生成

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
Route::get('login', 'Auth\LoginController@index')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', ['as' => 'register','uses' => 'Auth\RegisterController@register']);
Route::get('resetpass', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('resetpass', ['as' => 'password.email','uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('reset/{token}', ['as' => 'password.reset','uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::post('reset', 'Auth\ResetPasswordController@reset');


// 图片验证码
Route::get('captcha/{tmp}', 'Auth\LoginController@captcha');
Route::post('login/checkPhrase', 'Auth\LoginController@checkPhrase');


// info
Route::get('pass', function(){
  return view('welcome');
});


// API
Route::get('api/blogs', 'Api\IndexApi@all');
// Route::get('api/cates', 'Api\IndexApi@cates');
Route::get('api/hots', 'Api\IndexApi@hots');
Route::get('api/news', 'Api\IndexApi@news');
Route::get('api/tags', 'Api\IndexApi@tags');
Route::get('api/blogshow', 'Api\IndexApi@blogshow');
Route::get('api/hots2', 'Api\IndexApi@hots2');
// ReactApi
Route::post('rapi/blogs', 'Api\ReactApi@all');
Route::post('rapi/search', 'Api\ReactApi@searchBlog');
Route::get('rapi/showBlog', 'Api\ReactApi@showBlog');
Route::post('rapi/userPic', 'Api\ReactApi@saveUserpic');
// VueApi
Route::post('vapi/checkPhrase', 'Api\VueApi@checkPhrase');
Route::get('vapi/captcha/{tmp}', 'Api\VueApi@captcha');
//App2跳转
Route::get('app2/show/{id}', function(){
  return redirect('/app2');
});

// QC Music
Route::get('mapi/list/{lid}', 'Api\MusicApi@getList');
Route::post('mapi/audio', 'Api\MusicApi@getAudio');
Route::get('mapi/disc/{sid}', 'Api\MusicApi@getDisc');


