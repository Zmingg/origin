<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;

class HomeController extends Controller
{
    public $module = 'index'; 

    public function index()
    {
        $captcha = new CaptchaBuilder;
        $captcha->build();
        $phrase = $captcha->getPhrase();
        return view('auth.login',[
            'captcha'=>$captcha,
            'phrase'=>$phrase,
        ]);
    }



}
