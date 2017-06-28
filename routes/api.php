<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->get('/tokens', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'auth:api'], function () {
    // Route::get('captcha', 'Api\VueApi@deleteToken');
});
Route::post('registerCode', 'Api\VueApi@registerCode');
Route::post('codeCheck', 'Api\VueApi@codeCheck');
Route::post('signup', 'Api\VueApi@register');
Route::get('captcha', 'Api\VueApi@captcha');
Route::get('hashCheck', 'Api\VueApi@hashCheck');