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
Route::get('api/cates', 'Api\IndexApi@cates');
Route::get('api/hots', 'Api\IndexApi@hots');
Route::get('api/news', 'Api\IndexApi@news');
Route::get('api/tags', 'Api\IndexApi@tags');
Route::get('api/blogshow', 'Api\IndexApi@blogshow');
Route::get('api/hots2', 'Api\IndexApi@hots2');
// ReactApi
Route::post('rapi/blogs', 'Api\ReactApi@all');
Route::get('rapi/showBlog', 'Api\ReactApi@showBlog');
// VueApi
Route::post('vapi/checkPhrase', 'Api\VueApi@checkPhrase');
Route::get('vapi/captcha/{tmp}', 'Api\VueApi@captcha');
//App2跳转
Route::get('app2/show/{id}', function(){
  return redirect('/app');
});

Route::get('redirect',function(){
  $client = new \GuzzleHttp\Client();
  $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM4NDBhNGE4ZjI5NDEyNmQxMDJlMzRlMjQ2YjEzN2MyZjZkODI4NThkMTQwYTdlMGU2ZTM0YTYwYjQ0YWFkMWNmMGU5YzJiN2E3MmI0MmFmIn0.eyJhdWQiOiI0IiwianRpIjoiYzg0MGE0YThmMjk0MTI2ZDEwMmUzNGUyNDZiMTM3YzJmNmQ4Mjg1OGQxNDBhN2UwZTZlMzRhNjBiNDRhYWQxY2YwZTljMmI3YTcyYjQyYWYiLCJpYXQiOjE0OTgyMTk3NTMsIm5iZiI6MTQ5ODIxOTc1MywiZXhwIjoxNTI5NzU1NzUzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.pMw_A1Xl9QdeWYB5WTGifHk7E3wuZQU0WfAlDMDK8HCFrDNp8y3P3QAu873PpAHqg2qGmAxqOpt5vbnok0qXBjaQkJRLDfn4WVmNXsyYqfLqT6F6BIXS30kiPscGidEguF5XE9d04BLTvj7J-lCJjvJJyr7msDNNVHQmHVYuyxpP8snD9-zKAd2t0WkW2rNH7DRPW-flNtdw6cG150O-RCzlurCHU0uYizDq00ziSiaS-o1ra2lzM6FSc3uebykzrbd3ssbosK_l5pkiMTkBQ5lxxfcguNZcanpLlqM7DKowPrmTMLP2gZwqrnD9zfkpl94tZZ8LNxs5FxTe-x9MlYYl3nkqG-91WFhEnpp-x8Zm6sE95wJkP75OU6NPI2emMBld5ROAXo3SV2P50AazviyXX0O34pAP0O-Ru8kt6w30f1_B3I80WHVzJCExynjEvuOQiJzIitQHw6YejiXqBS-hrffyGQY6fBWphbNezFMjmMXooP-vmY4n-FJe3n3Md37bxARpdDtz8rmaLoCGdvXG86NOugEwZCEy27oDK8O1r6oQNEeI-Im0Nrmh5g14p9-IzSQTbwQf7doLjZW4k9WHra7v17CcSigmM4UfXF7d4OWX2bTI3iEPA4r6q3bFwxWThSNvW3U7zmSfitsi8ghRgcskQP700jbXrvwpJhQ';
  $response = $client->delete('http://laravel.cc/api/token',[
    'headers' => [
        'Accept'     => 'application/json',
        'Authorization'      => 'Bearer '.$token,
    ],
    'form_params' => [
        'username' => '157679749@qq.com',
        'password' => 'blank1987',
    ]
  ]);
  return $response;
});