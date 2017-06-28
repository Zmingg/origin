<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session, Captcha, Mail, DB, Hash;
use App\Http\Models\User;

class VueApi extends Controller
{
	
	public function __construct(){
		// 指定允许其他域名访问  
		header('Access-Control-Allow-Origin:*');  
		// 响应类型  
		// header('Access-Control-Allow-Methods:GET');  
		// 响应头设置  
		header('Access-Control-Allow-Headers:x-requested-with,content-type');  
	}

	public function checkPhrase(Request $request){
		$userInput = $request->get('captcha');
        $captcha = Session::get('captcha');
        
        if($captcha==$userInput) {
            return $captcha;
        } else {
            return redirect()->back()
                ->withErrors(['captcha'=>'验证码错误'])
                ->withInput();
        }
	}

	public function captcha(){
        $cap = Captcha::create();
        dump($cap->text);
    	$src = Captcha::src();
        return response()->json(['src'=>$src]);
    }

    public function deleteToken(Request $request){
        
        return $request->username;
    }

    public function sendMail()
    {
        $name = '学院君';
        $flag = Mail::send('mail.test',['name'=>$name],function($message){
            $to = '157679749@qq.com';
            $message ->to($to)->subject('测试邮件');
        });

        if($flag){
            echo '发送邮件成功，请查收！';
        }else{
            echo '发送邮件失败，请重试！';
        }
    }

    public function hashCheck()
    {
        $id = 1;
        $res = User::where('id',$id)->first();
        $result = Hash::check('blank1987', $res->password);
        dd($result);
    }

    public function registerCode(Request $request)
    {
      $to = $request->email;
      if (User::where('email',$to)->count()>0) {
        return response()->json(['ok'=>false,'message'=>'此邮箱已被注册']);
      }
      $code = mt_rand(100000,999999);
      $created_at = date_format(date_create(),"Y-m-d H:i:s");
      $expires_at = date_add(date_create(),date_interval_create_from_date_string("60 second"));
      $has = DB::table('register_codes')->where('email',$to)->count();
      if ($has!=0) {
           DB::table('register_codes')
              ->where('email', $to)
              ->update([
                  'code' => bcrypt($code),
                  'created_at' => $created_at,
                  'expires_at' => $expires_at
              ]);
      } else {
          DB::table('register_codes')->insert([
              'email' => $to, 
              'code' => bcrypt($code),
              'created_at' => $created_at,
              'expires_at' => $expires_at
          ]);
      }
      $this->to = $to;

      Mail::send('mail.test',['name'=>'清尘','code'=>$code],function($message){
          $message ->to($this->to)->subject('感谢您注册清尘居');
      });

      return response()->json(['ok'=>true,'message'=>'成功']);

    }

    public function codeCheck(Request $request)
    {
      $code = $request->code;
      $email = $request->email;
      $data = DB::table('register_codes')->where('email',$email)->first();
      $diff = date_diff(date_create(),date_create($data->expires_at));
      if ($diff->format('%R')=='-') {
        return response()->json(['ok'=>false,'message'=>'验证码已失效']);
      }
      $result = Hash::check($code, $data->code);
      if ($result) {
        return response()->json(['ok'=>true,'message'=>'成功']);
      } else {
        return response()->json(['ok'=>false,'message'=>'验证码不正确']);
      }
    }

    public function register(Request $request)
    {
      $hashCode = DB::table('register_codes')->where('email',$request->email)->first()->code;
      $result = Hash::check($request->code, $hashCode);
      if (!$result) {
        return response()->json(['ok'=>false,'message'=>'操作不合法']);
      }
      $user = new User;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->name = str_random(10);
      if($user->save()){
        return response()->json(['ok'=>true,'message'=>'注册成功']);
      }else{
        return response()->json(['ok'=>false,'message'=>'注册失败']);
      }
    }



}