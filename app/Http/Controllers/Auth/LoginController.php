<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    // public $phrase;

    use AuthenticatesUsers;

    public $module = 'index'; 


    public function index()
    {
        // $arr = ['name'=>'ali213','age'=>20];
        // echo serialize($arr);
        // echo strlen(serialize($arr));
        $value = Cache::get('key');
        return view('auth.login');
    }

    public function captcha($tmp)
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 300, $height = 60, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        Session::flash('captcha', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

    public function checkPhrase(Request $request)
    {
        $userInput = $request->get('captcha');
        $captcha = Session::get('captcha');

        if($captcha==$userInput) {
            return $this->login($request);
        } else {
            return redirect()->back()
                ->withErrors(['captcha'=>'验证码错误'])
                ->withInput();
        }
    }
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        return '/';
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function username()
    {
        return 'name';
    }
}
